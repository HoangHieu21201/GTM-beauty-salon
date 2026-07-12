<script>
    (() => {
        const form = document.querySelector('[data-clinic-form]');

        if (!form) return;

        const errorClass = 'mt-1.5 text-[12px] font-medium text-red-600';
        const invalidClasses = ['border-red-400', 'focus:border-red-500', 'focus:ring-red-100'];
        const normalClasses = ['border-gray-200', 'focus:border-primary', 'focus:ring-primary/20'];

        const validators = {
            name: (input) => validateRequired(input, 'Vui lòng nhập tên cơ sở.'),
            address: (input) => validateRequired(input, 'Vui lòng nhập địa chỉ cơ sở.'),
            phone: (input) => validateRequired(input, 'Vui lòng nhập số điện thoại.'),
            website: (input) => validateRequired(input, 'Vui lòng nhập website.') || validateUrl(input, 'Website phải là một đường dẫn hợp lệ.'),
            description: (input) => validateRequired(input, 'Vui lòng nhập mô tả cơ sở.'),
            image_url: (input) => validateImages(input) || validateUrl(input, 'URL ảnh phải là một đường dẫn hợp lệ.'),
            score: (input) => validateRequired(input, 'Vui lòng nhập điểm xếp hạng.') || validateIntegerMin(input, 0, 'Điểm xếp hạng phải là số nguyên từ 0 trở lên.'),
            rating: (input) => validateRequired(input, 'Vui lòng nhập rating.') || validateNumberRange(input, 0, 5, 'Rating phải là số từ 0 đến 5.'),
            review_count: (input) => validateRequired(input, 'Vui lòng nhập số đánh giá.') || validateIntegerMin(input, 0, 'Số đánh giá phải là số nguyên từ 0 trở lên.'),
            category_id: (input) => validateRequired(input, 'Vui lòng chọn danh mục.'),
            status: (input) => validateRequired(input, 'Vui lòng chọn trạng thái.'),
        };

        form.addEventListener('submit', (event) => {
            const firstInvalid = validateForm();

            if (!firstInvalid) return;

            event.preventDefault();
            event.stopImmediatePropagation();

            firstInvalid.scrollIntoView({ behavior: 'smooth', block: 'center' });
            firstInvalid.focus({ preventScroll: true });
        }, true);

        Object.keys(validators).forEach((name) => {
            const input = form.elements[name];

            if (!input) return;

            ['input', 'change'].forEach((eventName) => {
                input.addEventListener(eventName, () => validateInput(input));
            });
        });

        form.querySelector('input[name="image_files[]"]')?.addEventListener('change', () => {
            const imageUrl = form.elements.image_url;

            if (imageUrl) validateInput(imageUrl);
        });

        form.addEventListener('click', (event) => {
            if (!event.target.closest('[data-remove-new-image], [data-remove-preview]')) return;

            window.setTimeout(() => {
                const imageUrl = form.elements.image_url;

                if (imageUrl) validateInput(imageUrl);
            }, 0);
        });

        function validateForm() {
            let firstInvalid = null;

            Object.keys(validators).forEach((name) => {
                const input = form.elements[name];

                if (!input) return;

                if (!validateInput(input) && !firstInvalid) {
                    firstInvalid = input;
                }
            });

            return firstInvalid;
        }

        function validateInput(input) {
            const validator = validators[input.name];
            const message = validator ? validator(input) : '';

            if (message) {
                showFieldError(input, message);
                return false;
            }

            clearFieldError(input);
            return true;
        }

        function validateRequired(input, message) {
            return input.value.trim() ? '' : message;
        }

        function validateUrl(input, message) {
            const value = input.value.trim();

            if (!value) return '';

            try {
                const url = new URL(value);
                return ['http:', 'https:'].includes(url.protocol) ? '' : message;
            } catch (_) {
                return message;
            }
        }

        function validateImages(input) {
            const imageUrl = input.value.trim();
            const fileInput = form.querySelector('input[name="image_files[]"]');
            const hasNewFiles = fileInput && fileInput.files && fileInput.files.length > 0;
            const hasExistingImages = form.querySelectorAll('input[name="existing_images[]"]').length > 0;

            return imageUrl || hasNewFiles || hasExistingImages
                ? ''
                : 'Vui lòng tải ảnh lên hoặc nhập URL ảnh.';
        }

        function validateIntegerMin(input, min, message) {
            const value = input.value.trim();

            if (!value) return '';

            const number = Number(value);
            return Number.isInteger(number) && number >= min ? '' : message;
        }

        function validateNumberRange(input, min, max, message) {
            const value = input.value.trim();

            if (!value) return '';

            const number = Number(value);
            return Number.isFinite(number) && number >= min && number <= max ? '' : message;
        }

        function showFieldError(input, message) {
            const id = fieldErrorId(input);
            const serverError = document.getElementById(id);
            let error = serverError || form.querySelector(`[data-client-error-for="${input.name}"]`);

            if (!error) {
                error = document.createElement('p');
                error.dataset.clientErrorFor = input.name;
                error.className = errorClass;
                input.insertAdjacentElement('afterend', error);
            }

            error.id = id;
            error.textContent = message;
            input.setAttribute('aria-invalid', 'true');
            input.setAttribute('aria-describedby', id);
            input.classList.remove(...normalClasses);
            input.classList.add(...invalidClasses);
        }

        function clearFieldError(input) {
            const id = fieldErrorId(input);
            const error = form.querySelector(`[data-client-error-for="${input.name}"], #${CSS.escape(id)}`);

            if (error) {
                error.remove();
            }

            input.removeAttribute('aria-invalid');
            input.removeAttribute('aria-describedby');
            input.classList.remove(...invalidClasses);
            input.classList.add(...normalClasses);
        }

        function fieldErrorId(input) {
            return input.name.replace(/_/g, '-') + '-error';
        }
    })();
</script>
