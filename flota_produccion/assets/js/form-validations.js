/**
 * Sistema de Validaciones en Tiempo Real para Formularios
 * Archivo reutilizable para todos los módulos
 */

class FormValidator {
    constructor(formId, config = {}) {
        this.form = document.getElementById(formId);
        this.config = {
            showProgress: true,
            enableRealTime: true,
            ...config
        };
        
        this.isEditing = false;
        this.currentId = null;
        this.validations = {};
        this.progressBar = null;
        this.progressText = null;
        
        this.init();
    }
    
    init() {
        if (!this.form) return;
        
        this.setupValidations();
        this.setupEventListeners();
        this.setupProgressBar();
    }
    
    setupValidations() {
        // Validaciones para buses
        this.validations.buses = {
            placa: {
                pattern: /^[A-Z]{2,3}-?\d{3,4}$/,
                message: 'Formato inválido. Use: ABC-123 o ABC123',
                validate: (value) => this.validations.buses.placa.pattern.test(value)
            },
            marca: {
                pattern: /^[A-Za-zÁáÉéÍíÓóÚúÑñ\s]+$/,
                message: 'Solo letras y espacios permitidos',
                validate: (value) => this.validations.buses.marca.pattern.test(value) && value.length >= 2
            },
            modelo: {
                pattern: /^[A-Za-z0-9ÁáÉéÍíÓóÚúÑñ\s\-]+$/,
                message: 'Solo letras, números, espacios y guiones permitidos',
                validate: (value) => this.validations.buses.modelo.pattern.test(value) && value.length >= 2
            },
            anio: {
                min: 1900,
                max: new Date().getFullYear() + 1,
                message: `Año debe estar entre 1900 y ${new Date().getFullYear() + 1}`,
                validate: (value) => {
                    const year = parseInt(value);
                    return year >= this.validations.buses.anio.min && year <= this.validations.buses.anio.max;
                }
            },
            capacidad: {
                min: 1,
                max: 100,
                message: 'Capacidad debe estar entre 1 y 100',
                validate: (value) => {
                    const cap = parseInt(value);
                    return cap >= this.validations.buses.capacidad.min && cap <= this.validations.buses.capacidad.max;
                }
            }
        };
        
        // Validaciones para conductores
        this.validations.conductores = {
            nombre: {
                pattern: /^[A-Za-zÁáÉéÍíÓóÚúÑñ\s]+$/,
                message: 'Solo letras y espacios permitidos',
                validate: (value) => this.validations.conductores.nombre.pattern.test(value) && value.length >= 3
            },
            licencia: {
                pattern: /^[A-Z0-9]{6,12}$/,
                message: 'Licencia debe tener 6-12 caracteres alfanuméricos',
                validate: (value) => this.validations.conductores.licencia.pattern.test(value)
            },
            telefono: {
                pattern: /^[\d\s\-\+\(\)]{7,15}$/,
                message: 'Teléfono debe tener 7-15 dígitos',
                validate: (value) => this.validations.conductores.telefono.pattern.test(value)
            },
            email: {
                pattern: /^[^\s@]+@[^\s@]+\.[^\s@]+$/,
                message: 'Formato de email inválido',
                validate: (value) => value === '' || this.validations.conductores.email.pattern.test(value),
                optional: true
            }
        };
        
        // Validaciones para rutas
        this.validations.rutas = {
            nombre: {
                pattern: /^[A-Za-z0-9ÁáÉéÍíÓóÚúÑñ\s\-]+$/,
                message: 'Solo letras, números, espacios y guiones permitidos',
                validate: (value) => this.validations.rutas.nombre.pattern.test(value) && value.length >= 3
            },
            origen: {
                pattern: /^[A-Za-zÁáÉéÍíÓóÚúÑñ\s\-]+$/,
                message: 'Solo letras, espacios y guiones permitidos',
                validate: (value) => this.validations.rutas.origen.pattern.test(value) && value.length >= 3
            },
            destino: {
                pattern: /^[A-Za-zÁáÉéÍíÓóÚúÑñ\s\-]+$/,
                message: 'Solo letras, espacios y guiones permitidos',
                validate: (value) => this.validations.rutas.destino.pattern.test(value) && value.length >= 3
            },
            distancia: {
                min: 0.1,
                max: 10000,
                message: 'Distancia debe estar entre 0.1 y 10,000 km',
                validate: (value) => {
                    const dist = parseFloat(value);
                    return dist >= this.validations.rutas.distancia.min && dist <= this.validations.rutas.distancia.max;
                }
            },
            tiempo_estimado: {
                pattern: /^[\d\s]+[hm]$/,
                message: 'Formato: 2h 30m o 2h',
                validate: (value) => this.validations.rutas.tiempo_estimado.pattern.test(value)
            }
        };
        
        // Validaciones para viajes
        this.validations.viajes = {
            bus_id: {
                message: 'Debe seleccionar un bus',
                validate: (value) => value !== ''
            },
            conductor_id: {
                message: 'Debe seleccionar un conductor',
                validate: (value) => value !== ''
            },
            ruta_id: {
                message: 'Debe seleccionar una ruta',
                validate: (value) => value !== ''
            },
            fecha_salida: {
                message: 'Fecha de salida es obligatoria',
                validate: (value) => value !== ''
            }
        };
    }
    
    setupEventListeners() {
        if (!this.config.enableRealTime) return;
        
        const inputs = this.form.querySelectorAll('input, select, textarea');
        inputs.forEach(input => {
            input.addEventListener('input', (e) => this.validateField(e));
            input.addEventListener('blur', (e) => this.validateField(e));
            input.addEventListener('change', (e) => this.validateField(e));
        });
    }
    
    setupProgressBar() {
        if (!this.config.showProgress) return;
        
        this.progressBar = this.form.querySelector('.progress-bar');
        this.progressText = this.form.querySelector('#progressText');
        
        if (!this.progressBar || !this.progressText) {
            console.warn('Progress bar elements not found');
        }
    }
    
    validateField(event) {
        const field = event.target;
        const fieldName = field.name;
        const value = field.value.trim();
        
        // Limpiar estados previos
        field.classList.remove('is-valid', 'is-invalid');
        
        // Determinar qué validación usar según el formulario
        let validation = null;
        let moduleType = this.getModuleType();
        
        if (moduleType && this.validations[moduleType] && this.validations[moduleType][fieldName]) {
            validation = this.validations[moduleType][fieldName];
        }
        
        // Si no hay validación específica, usar validación básica
        if (!validation) {
            validation = {
                validate: (value) => value !== '',
                message: 'Este campo es obligatorio'
            };
        }
        
        // Aplicar validación
        const isValid = validation.validate(value);
        
        if (isValid) {
            field.classList.add('is-valid');
            field.classList.remove('is-invalid');
            this.clearFieldError(fieldName);
        } else {
            field.classList.add('is-invalid');
            field.classList.remove('is-valid');
            this.showFieldError(fieldName, validation.message);
        }
        
        // Actualizar progreso
        this.updateProgress();
        
        return isValid;
    }
    
    getModuleType() {
        const formId = this.form.id;
        if (formId.includes('bus')) return 'buses';
        if (formId.includes('conductor')) return 'conductores';
        if (formId.includes('ruta')) return 'rutas';
        if (formId.includes('viaje')) return 'viajes';
        return null;
    }
    
    showFieldError(fieldName, message) {
        const errorElement = document.getElementById(fieldName + '-error');
        if (errorElement) {
            errorElement.textContent = message;
        }
    }
    
    clearFieldError(fieldName) {
        const errorElement = document.getElementById(fieldName + '-error');
        if (errorElement) {
            errorElement.textContent = '';
        }
    }
    
    updateProgress() {
        if (!this.progressBar || !this.progressText) return;
        
        const fields = this.form.querySelectorAll('input[required], select[required], textarea[required]');
        let validFields = 0;
        let totalFields = fields.length;
        
        fields.forEach(field => {
            if (field.classList.contains('is-valid')) {
                validFields++;
            }
        });
        
        const progress = (validFields / totalFields) * 100;
        
        this.progressBar.style.width = progress + '%';
        
        if (progress === 100) {
            this.progressBar.className = 'progress-bar bg-success';
            this.progressText.textContent = '¡Formulario completo! Puedes guardar';
            this.enableSubmitButton();
        } else if (progress >= 50) {
            this.progressBar.className = 'progress-bar bg-warning';
            this.progressText.textContent = `Progreso: ${validFields}/${totalFields} campos completados`;
            this.disableSubmitButton();
        } else {
            this.progressBar.className = 'progress-bar bg-danger';
            this.progressText.textContent = `Progreso: ${validFields}/${totalFields} campos completados`;
            this.disableSubmitButton();
        }
    }
    
    enableSubmitButton() {
        const submitBtn = this.form.querySelector('button[type="submit"]');
        if (submitBtn) {
            submitBtn.disabled = false;
        }
    }
    
    disableSubmitButton() {
        const submitBtn = this.form.querySelector('button[type="submit"]');
        if (submitBtn) {
            submitBtn.disabled = true;
        }
    }
    
    validateForm() {
        const fields = this.form.querySelectorAll('input[required], select[required], textarea[required]');
        let isValid = true;
        
        fields.forEach(field => {
            if (!this.validateField({ target: field })) {
                isValid = false;
            }
        });
        
        return isValid;
    }
    
    resetForm() {
        this.form.reset();
        this.isEditing = false;
        this.currentId = null;
        
        // Limpiar validaciones
        const fields = this.form.querySelectorAll('input, select, textarea');
        fields.forEach(field => {
            field.classList.remove('is-valid', 'is-invalid');
        });
        
        // Resetear progreso
        if (this.progressBar) {
            this.progressBar.style.width = '0%';
            this.progressBar.className = 'progress-bar bg-danger';
        }
        
        if (this.progressText) {
            this.progressText.textContent = 'Completa todos los campos para continuar';
        }
        
        this.disableSubmitButton();
    }
    
    setEditMode(id, data) {
        this.isEditing = true;
        this.currentId = id;
        
        // Llenar formulario con datos
        Object.keys(data).forEach(key => {
            const field = this.form.querySelector(`[name="${key}"]`);
            if (field) {
                field.value = data[key];
            }
        });
        
        // Validar todos los campos
        setTimeout(() => {
            const fields = this.form.querySelectorAll('input, select, textarea');
            fields.forEach(field => {
                this.validateField({ target: field });
            });
        }, 100);
    }
}

// Función helper para crear validadores
function createFormValidator(formId, config = {}) {
    return new FormValidator(formId, config);
}

// Exportar para uso en otros archivos
if (typeof module !== 'undefined' && module.exports) {
    module.exports = { FormValidator, createFormValidator };
}
