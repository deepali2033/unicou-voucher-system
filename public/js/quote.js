
                                                                                let currentStep = 1;
                                                                                const totalSteps = 9;
                                                                                let selectedCategoryId = null;

                                                                                // Category Selection Function
                                                                                function selectCategory(cardElement, categoryId, categoryName) {
                                                                                    document.querySelectorAll('#categoriesContainer .service-card').forEach(card => {
                                                                                        card.classList.remove('selected');
                                                                                    });

                                                                                    cardElement.classList.add('selected');

                                                                                    const radios = document.querySelectorAll('input[name="form_fields[category_booking_form]"]');
                                                                                    radios.forEach(radio => {
                                                                                        radio.checked = radio.value === categoryName;
                                                                                    });

                                                                                    selectedCategoryId = categoryId;
                                                                                    document.getElementById('selectedCategoryName').textContent = categoryName;

                                                                                    document.getElementById('selectedCategoryDisplay').classList.add('active');
                                                                                    document.getElementById('nextBtn').disabled = false;

                                                                                    loadServicesByCategory(categoryId);

                                                                                    updateAccordion();
                                                                                    saveFormDataToSession();

                                                                                    setTimeout(() => {
                                                                                        document.getElementById('selectedCategoryDisplay').scrollIntoView({ behavior: 'smooth', block: 'nearest' });
                                                                                    }, 100);
                                                                                }

                                                                                // Load Services by Selected Category
                                                                                function loadServicesByCategory(categoryId) {
                                                                                    fetch('{{ route("api.services-by-category") }}?category_id=' + categoryId)
                                                                                        .then(response => response.json())
                                                                                        .then(data => {
                                                                                            const container = document.getElementById('servicesContainer');
                                                                                            container.innerHTML = '';

                                                                                            if (data.success && data.data.length > 0) {
                                                                                                data.data.forEach(service => {
                                                                                                    const card = document.createElement('div');
                                                                                                    card.className = 'service-card';
                                                                                                    card.onclick = function() {
                                                                                                        selectService(this, service.id, service.name, service.price_from, service.price_to, service.short_description);
                                                                                                    };

                                                                                                    let priceDisplay = 'Contact for pricing';
                                                                                                    if (service.price_from && service.price_to) {
                                                                                                        priceDisplay = '$' + Math.floor(service.price_from) + ' - $' + Math.floor(service.price_to);
                                                                                                    } else if (service.price_from) {
                                                                                                        priceDisplay = 'From $' + Math.floor(service.price_from);
                                                                                                    }

                                                                                                    card.innerHTML = `
                                                                                                        <h4>${service.name}</h4>
                                                                                                        <div class="price">${priceDisplay}</div>
                                                                                                        <div class="description">${service.short_description}</div>
                                                                                                        <input type="radio" name="form_fields[service_booking_form]" value="${service.name}" style="display: none;" required>
                                                                                                    `;
                                                                                                    container.appendChild(card);
                                                                                                });
                                                                                            } else {
                                                                                                container.innerHTML = '<p>No services available in this category</p>';
                                                                                            }
                                                                                        })
                                                                                        .catch(err => {
                                                                                            console.error('Error loading services:', err);
                                                                                            document.getElementById('servicesContainer').innerHTML = '<p>Error loading services. Please try again.</p>';
                                                                                        });
                                                                                }

                                                                                // Service Card Selection Function
                                                                                function selectService(cardElement, serviceId, serviceName, priceFrom, priceTo, description) {
                                                                                    document.querySelectorAll('.service-card').forEach(card => {
                                                                                        card.classList.remove('selected');
                                                                                    });

                                                                                    cardElement.classList.add('selected');

                                                                                    const radios = document.querySelectorAll('input[name="form_fields[service_booking_form]"]');
                                                                                    radios.forEach(radio => {
                                                                                        radio.checked = radio.value === serviceName;
                                                                                    });

                                                                                    const displayCard = document.getElementById('selectedServiceDisplay');
                                                                                    document.getElementById('selectedServiceName').textContent = serviceName;

                                                                                    let priceDisplay = 'Contact for pricing';
                                                                                    if (priceFrom && priceTo) {
                                                                                        priceDisplay = '$' + Math.floor(priceFrom) + ' - $' + Math.floor(priceTo);
                                                                                    } else if (priceFrom) {
                                                                                        priceDisplay = 'From $' + Math.floor(priceFrom);
                                                                                    }
                                                                                    document.getElementById('selectedServicePrice').textContent = priceDisplay;
                                                                                    document.getElementById('selectedServiceDesc').textContent = description;

                                                                                    fetch('{{ route("api.service-details") }}?service_id=' + serviceId)
                                                                                        .then(response => response.json())
                                                                                        .then(data => {
                                                                                            if (data.success && data.data.duration) {
                                                                                                document.getElementById('selectedServiceDuration').textContent = data.data.duration;
                                                                                            }
                                                                                        })
                                                                                        .catch(err => console.log('Duration fetch error'));

                                                                                    displayCard.classList.add('active');
                                                                                    document.getElementById('nextBtn').disabled = false;

                                                                                    updateAccordion();
                                                                                    saveFormDataToSession();

                                                                                    setTimeout(() => {
                                                                                        displayCard.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
                                                                                    }, 100);
                                                                                }

                                                                                function showStep(step) {
                                                                                    const frequencyStep = document.getElementById('frequencyStep');
                                                                                    const selectedCategory = document.querySelector('input[name="form_fields[category_booking_form]"]:checked');
                                                                                    const selectedService = document.querySelector('input[name="form_fields[service_booking_form]"]:checked');

                                                                                    frequencyStep.style.display = 'block';

                                                                                    document.querySelectorAll('.step').forEach(el => el.classList.remove('active'));
                                                                                    const activeStep = document.querySelector(`.step[data-step="${step}"]`);
                                                                                    if (activeStep) {
                                                                                        activeStep.classList.add('active');
                                                                                        document.getElementById('currentStep').value = step;
                                                                                    }

                                                                                    // Update button visibility
                                                                                    document.getElementById('prevBtn').style.display = step > 1 ? 'inline-block' : 'none';
                                                                                    document.getElementById('nextBtn').style.display = step < totalSteps ? 'inline-block' : 'none';
                                                                                    document.getElementById('submitBtn').style.display = step === totalSteps ? 'inline-block' : 'none';

                                                                                    // Manage button state based on step and selections
                                                                                    let shouldDisable = false;

                                                                                    // Step 2: Category Selection
                                                                                    if (step === 2) {
                                                                                        shouldDisable = !selectedCategory;
                                                                                    }
                                                                                    // Step 3: Service Selection
                                                                                    else if (step === 3) {
                                                                                        shouldDisable = !selectedService;
                                                                                    }
                                                                                    // Step 4: Frequency (only if shown)
                                                                                    else if (step === 4 && frequencyStep.style.display !== 'none') {
                                                                                        const selectedFreq = document.querySelector('input[name="form_fields[frequency_booking_form]"]:checked');
                                                                                        shouldDisable = !selectedFreq;
                                                                                    }
                                                                                    // Step 5: Duration
                                                                                    else if (step === 5) {
                                                                                        const selectedDuration = document.querySelector('input[name="form_fields[duration_booking_form]"]:checked');
                                                                                        shouldDisable = !selectedDuration;
                                                                                    }
                                                                                    // Step 7: Pets
                                                                                    else if (step === 7) {
                                                                                        const selectedPets = document.querySelector('input[name="form_fields[pets_booking_form]"]:checked');
                                                                                        shouldDisable = !selectedPets;
                                                                                    }
                                                                                    // Step 8: Date
                                                                                    else if (step === 8) {
                                                                                        const selectedDate = document.getElementById('appointmentDate').value;
                                                                                        shouldDisable = !selectedDate;
                                                                                    }
                                                                                    // Step 9: Time
                                                                                    else if (step === 9) {
                                                                                        const selectedTime = document.getElementById('appointmentTime').value;
                                                                                        shouldDisable = !selectedTime;
                                                                                    }

                                                                                    if (step < totalSteps) {
                                                                                        document.getElementById('nextBtn').disabled = shouldDisable;
                                                                                    }

                                                                                    // Update accordion display
                                                                                    updateAccordion();
                                                                                }

                                                                                function collectFormData() {
                                                                                    return {
                                                                                        category_name: document.querySelector('input[name="form_fields[category_booking_form]"]:checked')?.value || '',
                                                                                        service_name: document.querySelector('input[name="form_fields[service_booking_form]"]:checked')?.value || '',
                                                                                        bedrooms: parseInt(document.querySelector('input[name="form_fields[bedrooms_booking_form]"]:checked')?.value || '0'),
                                                                                        bathrooms: parseInt(document.querySelector('input[name="form_fields[bathrooms_booking_form]"]:checked')?.value || '0'),
                                                                                        extras: document.querySelector('input[name="form_fields[extras_booking_form]"]:checked')?.value || '',
                                                                                        frequency: document.querySelector('input[name="form_fields[frequency_booking_form]"]:checked')?.value || '',
                                                                                        area: document.querySelector('input[name="form_fields[area_booking_form]"]:checked')?.value || '',
                                                                                        booking_date: document.getElementById('appointmentDate')?.value || '',
                                                                                        booking_time: document.getElementById('appointmentTime')?.value || '',
                                                                                        customer_name: document.querySelector('input[name="form_fields[name_booking_form]"]')?.value || '',
                                                                                        phone: document.querySelector('input[name="form_fields[tel_booking_form]"]')?.value || '',
                                                                                        email: document.querySelector('input[name="form_fields[email_booking_form]"]')?.value || '',
                                                                                        street_address: document.querySelector('input[name="form_fields[street_booking_form]"]')?.value || '',
                                                                                        city: document.querySelector('input[name="form_fields[city_booking_form]"]')?.value || '',
                                                                                        state: document.querySelector('input[name="form_fields[states_booking_form]"]')?.value || '',
                                                                                        zip_code: document.querySelector('input[name="form_fields[zip_code_booking_form]"]')?.value || '',
                                                                                        parking_info: document.querySelector('input[name="form_fields[where_to_park_booking_form]"]:checked')?.value || '',
                                                                                        flexible_time: document.querySelector('input[name="form_fields[flexible_time_booking_form]"]:checked')?.value || '',
                                                                                        entrance_info: document.querySelector('input[name="form_fields[entrance_info_booking_form]"]:checked')?.value || '',
                                                                                        pets: document.querySelector('input[name="form_fields[pets_booking_form]"]:checked')?.value || '',
                                                                                        special_instructions: document.querySelector('textarea[name="form_fields[message_booking_form]"]')?.value || ''
                                                                                    };
                                                                                }

                                                                                function saveFormDataToSession() {
                                                                                    const formData = collectFormData();
                                                                                    fetch('{{ route("book-services.save-session") }}', {
                                                                                        method: 'POST',
                                                                                        headers: {
                                                                                            'Content-Type': 'application/json',
                                                                                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content'),
                                                                                            'X-Requested-With': 'XMLHttpRequest'
                                                                                        },
                                                                                        body: JSON.stringify({ form_data: formData })
                                                                                    }).catch(err => console.log('Session save attempted'));
                                                                                }

                                                                                // Update accordion with current selections
                                                                                function updateAccordion() {
                                                                                    const accordion = document.getElementById('accordionContainer');
                                                                                    accordion.innerHTML = '';

                                                                                    const summaryData = {
                                                                                        'Category': document.querySelector('input[name="form_fields[category_booking_form]"]:checked')?.value || '',
                                                                                        'Service': document.querySelector('input[name="form_fields[service_booking_form]"]:checked')?.value || '',
                                                                                        'Address': document.querySelector('input[name="form_fields[street_booking_form]"]')?.value || '',
                                                                                        'Frequency': document.querySelector('input[name="form_fields[frequency_booking_form]"]:checked')?.value || '',
                                                                                        'Duration': document.querySelector('input[name="form_fields[duration_booking_form]"]:checked')?.value || '',
                                                                                        'Extra Services': document.querySelector('input[name="form_fields[extra_service_booking_form]"]:checked')?.value || '',
                                                                                        'Pets': document.querySelector('input[name="form_fields[pets_booking_form]"]:checked')?.value || '',
                                                                                        'Date': document.getElementById('appointmentDate')?.value || '',
                                                                                        'Time': document.getElementById('appointmentTime')?.value || '',
                                                                                        'Name': document.querySelector('input[name="form_fields[name_booking_form]"]')?.value || '',
                                                                                        'Email': document.querySelector('input[name="form_fields[email_booking_form]"]')?.value || '',
                                                                                        'Phone': document.querySelector('input[name="form_fields[phone_booking_form]"]')?.value || ''
                                                                                    };

                                                                                    const stepLabels = {
                                                                                        'Category': '<span class="accordion-label-icon">ðŸ </span> Category',
                                                                                        'Service': '<span class="accordion-label-icon">âœ“</span> Service',
                                                                                        'Address': '<span class="accordion-label-icon">ðŸ“</span> Address',
                                                                                        'Frequency': '<span class="accordion-label-icon">â²</span> Frequency',
                                                                                        'Duration': '<span class="accordion-label-icon">â±</span> Duration',
                                                                                        'Extra Services': '<span class="accordion-label-icon">âž•</span> Extras',
                                                                                        'Pets': '<span class="accordion-label-icon">ðŸ¾</span> Pets',
                                                                                        'Date': '<span class="accordion-label-icon">ðŸ“…</span> Date',
                                                                                        'Time': '<span class="accordion-label-icon">ðŸ•’</span> Time',
                                                                                        'Name': '<span class="accordion-label-icon">ðŸ‘¤</span> Name',
                                                                                        'Email': '<span class="accordion-label-icon">âœ‰</span> Email',
                                                                                        'Phone': '<span class="accordion-label-icon">ðŸ“±</span> Phone'
                                                                                    };

                                                                                    let hasAnyValue = false;
                                                                                    for (const [key, value] of Object.entries(summaryData)) {
                                                                                        if (value) {
                                                                                            hasAnyValue = true;
                                                                                            const item = document.createElement('div');
                                                                                            item.className = 'accordion-item';

                                                                                            const header = document.createElement('div');
                                                                                            header.className = 'accordion-header';
                                                                                            header.innerHTML = `<span>${stepLabels[key]}</span><span class="accordion-toggle">â–¼</span>`;

                                                                                            const content = document.createElement('div');
                                                                                            content.className = 'accordion-content';
                                                                                            content.innerHTML = `<p><strong>${key}:</strong> ${value}</p>`;

                                                                                            header.onclick = function () {
                                                                                                header.classList.toggle('active');
                                                                                                content.classList.toggle('active');
                                                                                            };

                                                                                            item.appendChild(header);
                                                                                            item.appendChild(content);
                                                                                            accordion.appendChild(item);
                                                                                        }
                                                                                    }

                                                                                    if (!hasAnyValue) {
                                                                                        accordion.innerHTML = '<p style="color: #999; font-size: 13px; text-align: center; padding: 20px 0;">Your selections will appear here</p>';
                                                                                    }
                                                                                }

                                                                                // Generic option card selection for radio buttons
                                                                                function selectOption(cardElement, fieldName, value, buttonId = null) {
                                                                                    const container = cardElement.parentElement;
                                                                                    container.querySelectorAll('.option-card').forEach(card => {
                                                                                        card.classList.remove('selected');
                                                                                    });

                                                                                    cardElement.classList.add('selected');

                                                                                    const radio = cardElement.querySelector('input[type="radio"]');
                                                                                    if (radio) {
                                                                                        radio.checked = true;
                                                                                    }

                                                                                    if (buttonId) {
                                                                                        const button = document.getElementById(buttonId);
                                                                                        if (button) {
                                                                                            button.disabled = false;
                                                                                        }
                                                                                    }

                                                                                    // Update accordion and save to session
                                                                                    updateAccordion();
                                                                                    saveFormDataToSession();
                                                                                }

                                                                                // Generic option card toggle for checkboxes
                                                                                function toggleOption(cardElement, fieldName, value) {
                                                                                    const checkbox = cardElement.querySelector('input[type="checkbox"]');
                                                                                    if (checkbox) {
                                                                                        checkbox.checked = !checkbox.checked;
                                                                                        if (checkbox.checked) {
                                                                                            cardElement.classList.add('selected');
                                                                                        } else {
                                                                                            cardElement.classList.remove('selected');
                                                                                        }
                                                                                    }

                                                                                    // Update accordion and save to session
                                                                                    updateAccordion();
                                                                                    saveFormDataToSession();
                                                                                }

                                                                                // Calendar variables
                                                                                let currentCalendarDate = new Date();

                                                                                // Render calendar
                                                                                function renderCalendar() {
                                                                                    const year = currentCalendarDate.getFullYear();
                                                                                    const month = currentCalendarDate.getMonth();
                                                                                    const firstDay = new Date(year, month, 1);
                                                                                    const lastDay = new Date(year, month + 1, 0);
                                                                                    const daysInMonth = lastDay.getDate();
                                                                                    const startingDayOfWeek = firstDay.getDay();

                                                                                    document.getElementById('calendarMonth').textContent =
                                                                                        currentCalendarDate.toLocaleDateString('en-US', { month: 'long', year: 'numeric' });

                                                                                    const calendarDays = document.getElementById('calendarDays');
                                                                                    calendarDays.innerHTML = '';

                                                                                    // Previous month's days
                                                                                    const prevMonth = new Date(year, month, 0);
                                                                                    const daysInPrevMonth = prevMonth.getDate();
                                                                                    for (let i = startingDayOfWeek - 1; i >= 0; i--) {
                                                                                        const dayDiv = document.createElement('div');
                                                                                        dayDiv.className = 'calendar-day other-month';
                                                                                        dayDiv.textContent = daysInPrevMonth - i;
                                                                                        calendarDays.appendChild(dayDiv);
                                                                                    }

                                                                                    // Current month's days
                                                                                    const today = new Date();
                                                                                    for (let day = 1; day <= daysInMonth; day++) {
                                                                                        const dayDiv = document.createElement('div');
                                                                                        dayDiv.className = 'calendar-day';
                                                                                        dayDiv.textContent = day;

                                                                                        const fullDate = new Date(year, month, day);

                                                                                        // Disable past dates
                                                                                        if (fullDate < new Date(today.getFullYear(), today.getMonth(), today.getDate())) {
                                                                                            dayDiv.classList.add('other-month');
                                                                                            dayDiv.onclick = null;
                                                                                        } else {
                                                                                            // Highlight today
                                                                                            if (fullDate.toDateString() === today.toDateString()) {
                                                                                                dayDiv.classList.add('today');
                                                                                            }

                                                                                            dayDiv.onclick = function () {
                                                                                                selectDate(fullDate);
                                                                                            };
                                                                                        }
                                                                                        calendarDays.appendChild(dayDiv);
                                                                                    }

                                                                                    // Next month's days
                                                                                    let nextDay = 1;
                                                                                    const totalCells = calendarDays.children.length;
                                                                                    for (let i = totalCells; i < 42; i++) {
                                                                                        const dayDiv = document.createElement('div');
                                                                                        dayDiv.className = 'calendar-day other-month';
                                                                                        dayDiv.textContent = nextDay;
                                                                                        calendarDays.appendChild(dayDiv);
                                                                                        nextDay++;
                                                                                    }
                                                                                }

                                                                                function previousMonth() {
                                                                                    currentCalendarDate.setMonth(currentCalendarDate.getMonth() - 1);
                                                                                    renderCalendar();
                                                                                }

                                                                                function nextMonth() {
                                                                                    currentCalendarDate.setMonth(currentCalendarDate.getMonth() + 1);
                                                                                    renderCalendar();
                                                                                }

                                                                                function selectDate(date) {
                                                                                    const dateString = date.toISOString().split('T')[0];
                                                                                    document.getElementById('appointmentDate').value = dateString;

                                                                                    const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
                                                                                    document.getElementById('selectedDateDisplay').textContent =
                                                                                        'âœ“ Selected: ' + date.toLocaleDateString('en-US', options);

                                                                                    // Update calendar display
                                                                                    document.querySelectorAll('.calendar-day').forEach(day => {
                                                                                        day.classList.remove('selected');
                                                                                    });
                                                                                    event.target.classList.add('selected');

                                                                                    // Enable time selection by generating time slots
                                                                                    generateTimeSlots();

                                                                                    // Update accordion and save to session
                                                                                    updateAccordion();
                                                                                    saveFormDataToSession();

                                                                                    // Enable Continue button
                                                                                    document.getElementById('nextBtn').disabled = false;
                                                                                }

                                                                                // Generate time slots
                                                                                function generateTimeSlots() {
                                                                                    const timeSlots = document.getElementById('timeSlots');
                                                                                    timeSlots.innerHTML = '';

                                                                                    const times = [
                                                                                        '08:00', '09:00', '10:00', '11:00', '12:00',
                                                                                        '13:00', '14:00', '15:00', '16:00', '17:00', '18:00'
                                                                                    ];

                                                                                    times.forEach(time => {
                                                                                        const slot = document.createElement('div');
                                                                                        slot.className = 'time-slot';
                                                                                        slot.textContent = time;
                                                                                        slot.onclick = function () {
                                                                                            selectTime(this, time);
                                                                                        };
                                                                                        timeSlots.appendChild(slot);
                                                                                    });
                                                                                }

                                                                                function selectTime(element, time) {
                                                                                    document.querySelectorAll('.time-slot').forEach(slot => {
                                                                                        slot.classList.remove('selected');
                                                                                    });

                                                                                    element.classList.add('selected');
                                                                                    document.getElementById('appointmentTime').value = time;
                                                                                    document.getElementById('selectedTimeDisplay').textContent = 'âœ“ Selected: ' + time;

                                                                                    // Update accordion and save to session
                                                                                    updateAccordion();
                                                                                    saveFormDataToSession();

                                                                                    document.getElementById('nextBtn').disabled = false;
                                                                                }

                                                                                function changeStep(direction) {
                                                                                    const activeStep = document.querySelector('.step.active');
                                                                                    if (!activeStep) return;

                                                                                    currentStep = parseInt(activeStep.getAttribute('data-step'));

                                                                                    // Validation for each step before moving forward
                                                                                    if (direction > 0) {
                                                                                        // Step 2: Category Selection
                                                                                        if (currentStep === 2) {
                                                                                            const selectedCategory = document.querySelector('input[name="form_fields[category_booking_form]"]:checked');
                                                                                            if (!selectedCategory) {
                                                                                                alert('Please select a category to continue');
                                                                                                return;
                                                                                            }
                                                                                        }
                                                                                        // Step 3: Service Selection
                                                                                        else if (currentStep === 3) {
                                                                                            const selectedService = document.querySelector('input[name="form_fields[service_booking_form]"]:checked');
                                                                                            if (!selectedService) {
                                                                                                alert('Please select a cleaning service to continue');
                                                                                                return;
                                                                                            }
                                                                                        }
                                                                                        // Step 4: Frequency (only if shown)
                                                                                        else if (currentStep === 4) {
                                                                                            const frequencyStep = document.getElementById('frequencyStep');
                                                                                            if (frequencyStep.style.display !== 'none') {
                                                                                                const selectedFreq = document.querySelector('input[name="form_fields[frequency_booking_form]"]:checked');
                                                                                                if (!selectedFreq) {
                                                                                                    alert('Please select a cleaning frequency to continue');
                                                                                                    return;
                                                                                                }
                                                                                            }
                                                                                        }
                                                                                        // Step 5: Duration
                                                                                        else if (currentStep === 5) {
                                                                                            const selectedDuration = document.querySelector('input[name="form_fields[duration_booking_form]"]:checked');
                                                                                            if (!selectedDuration) {
                                                                                                alert('Please select a service duration to continue');
                                                                                                return;
                                                                                            }
                                                                                        }
                                                                                        // Step 7: Pets
                                                                                        else if (currentStep === 7) {
                                                                                            const selectedPets = document.querySelector('input[name="form_fields[pets_booking_form]"]:checked');
                                                                                            if (!selectedPets) {
                                                                                                alert('Please select whether you have pets to continue');
                                                                                                return;
                                                                                            }
                                                                                        }
                                                                                        // Step 8: Date
                                                                                        else if (currentStep === 8) {
                                                                                            const selectedDate = document.getElementById('appointmentDate').value;
                                                                                            if (!selectedDate) {
                                                                                                alert('Please select an appointment date to continue');
                                                                                                return;
                                                                                            }
                                                                                        }
                                                                                        // Step 9: Time
                                                                                        else if (currentStep === 9) {
                                                                                            const selectedTime = document.getElementById('appointmentTime').value;
                                                                                            if (!selectedTime) {
                                                                                                alert('Please select an appointment time to continue');
                                                                                                return;
                                                                                            }
                                                                                        }
                                                                                    }

                                                                                    currentStep += direction;

                                                                                    if (currentStep >= 1 && currentStep <= totalSteps) {
                                                                                        showStep(currentStep);
                                                                                    }
                                                                                }

                                                                                // Add event listeners for input fields
                                                                                const addressField = document.querySelector('input[name="form_fields[street_booking_form]"]');
                                                                                if (addressField) {
                                                                                    addressField.addEventListener('input', function () {
                                                                                        updateAccordion();
                                                                                        saveFormDataToSession();
                                                                                    });
                                                                                }

                                                                                const nameField = document.querySelector('input[name="form_fields[name_booking_form]"]');
                                                                                if (nameField) {
                                                                                    nameField.addEventListener('input', function () {
                                                                                        updateAccordion();
                                                                                        saveFormDataToSession();
                                                                                    });
                                                                                }

                                                                                const emailField = document.querySelector('input[name="form_fields[email_booking_form]"]');
                                                                                if (emailField) {
                                                                                    emailField.addEventListener('input', function () {
                                                                                        updateAccordion();
                                                                                        saveFormDataToSession();
                                                                                    });
                                                                                }

                                                                                const phoneField = document.querySelector('input[name="form_fields[phone_booking_form]"]');
                                                                                if (phoneField) {
                                                                                    phoneField.addEventListener('input', function () {
                                                                                        updateAccordion();
                                                                                        saveFormDataToSession();
                                                                                    });
                                                                                }

                                                                                // Submit booking form
                                                                                function submitBookingForm() {
                                                                                    const formData = collectFormData();
                                                                                    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

                                                                                    fetch('{{ route("book-services.submit") }}', {
                                                                                        method: 'POST',
                                                                                        headers: {
                                                                                            'Content-Type': 'application/json',
                                                                                            'X-CSRF-TOKEN': csrfToken,
                                                                                            'X-Requested-With': 'XMLHttpRequest'
                                                                                        },
                                                                                        body: JSON.stringify(formData)
                                                                                    })
                                                                                        .then(response => response.json())
                                                                                        .then(data => {
                                                                                            if (data.status === 401) {
                                                                                                window.location.href = data.redirect;
                                                                                            } else if (data.status === 200) {
                                                                                                // alert('âœ… ' + (data.message || 'Your booking has been submitted successfully!'));
                                                                                                setTimeout(() => {
                                                                                                    window.location.href = data.redirect;
                                                                                                }, 1500);
                                                                                            } else {
                                                                                                alert('âŒ ' + (data.message || 'An error occurred. Please try again.'));
                                                                                            }
                                                                                        })
                                                                                        .catch(error => {
                                                                                            console.error('Error:', error);
                                                                                            alert('âŒ An error occurred while submitting your booking. Please try again.');
                                                                                        });
                                                                                }

                                                                                // Initialize
                                                                                @php
                                                                                    $shouldShowFinalStep = session()->has('show_final_step');
                                                                                    session()->forget('show_final_step');
                                                                                @endphp
                                                                                @if($shouldShowFinalStep)
                                                                                    restoreFormFromSession();
                                                                                    showStep(9);
                                                                                @else
                                                                                    showStep(1);
                                                                                @endif
                                                                                renderCalendar();
                                                                                generateTimeSlots();
                                                                                updateAccordion();

                                                                                // Function to restore form data from session
                                                                                function restoreFormFromSession() {
                                                                                    @php
                                                                                        $bookingData = session('booking_form_data', []);
                                                                                    @endphp

                                                                                    @if(!empty($bookingData))
                                                                                        // Restore address
                                                                                        const addressField = document.querySelector('input[name="form_fields[street_booking_form]"]');
                                                                                        if (addressField && '{{ $bookingData['street_address'] ?? '' }}') {
                                                                                            addressField.value = '{{ $bookingData['street_address'] }}';
                                                                                        }

                                                                                        // Restore date
                                                                                        const dateField = document.getElementById('appointmentDate');
                                                                                        if (dateField && '{{ $bookingData['booking_date'] ?? '' }}') {
                                                                                            dateField.value = '{{ $bookingData['booking_date'] }}';
                                                                                            document.getElementById('selectedDateDisplay').textContent = 'âœ“ Selected: ' + formatDateDisplay('{{ $bookingData['booking_date'] }}');
                                                                                        }

                                                                                        // Restore time
                                                                                        const timeField = document.getElementById('appointmentTime');
                                                                                        if (timeField && '{{ $bookingData['booking_time'] ?? '' }}') {
                                                                                            timeField.value = '{{ $bookingData['booking_time'] }}';
                                                                                            document.getElementById('selectedTimeDisplay').textContent = 'âœ“ Selected: {{ $bookingData['booking_time'] }}';
                                                                                        }
                                                                                    @endif
                                                                                }

                                                                                function formatDateDisplay(dateString) {
                                                                                    try {
                                                                                        const date = new Date(dateString);
                                                                                        const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
                                                                                        return date.toLocaleDateString('en-US', options);
                                                                                    } catch (e) {
                                                                                        return dateString;
                                                                                    }
                                                                                }
                                                                            
