document.addEventListener('DOMContentLoaded', () => {

    // ==========================================
    // 1. SLIDE THEME TOGGLE (SVG ICONS)
    // ==========================================
    const themeBtn = document.getElementById('theme-toggle');
    const thumb = themeBtn ? themeBtn.querySelector('.switch-thumb') : null;
    const root = document.documentElement;

    const sunIcon = `<svg viewBox="0 0 24 24" fill="none" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="5"></circle><line x1="12" y1="1" x2="12" y2="3"></line><line x1="12" y1="21" x2="12" y2="23"></line><line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line><line x1="1" y1="12" x2="3" y2="12"></line><line x1="21" y1="12" x2="23" y2="12"></line><line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line></svg>`;
    const moonIcon = `<svg viewBox="0 0 24 24" fill="none" stroke-linecap="round" stroke-linejoin="round"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path></svg>`;

    const savedTheme = localStorage.getItem('theme') || 'dark';
    root.setAttribute('data-theme', savedTheme);
    
    if (thumb) {
        updateToggle(savedTheme);
    }

    if (themeBtn) {
        themeBtn.addEventListener('click', () => {
            const currentTheme = root.getAttribute('data-theme');
            const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
            root.setAttribute('data-theme', newTheme);
            localStorage.setItem('theme', newTheme);
            updateToggle(newTheme);
        });
    }

    function updateToggle(theme) {
        if (thumb) {
            thumb.innerHTML = theme === 'dark' ? moonIcon : sunIcon;
        }
    }

    // ==========================================
    // 2. TYPING ANIMATION (SIDEBAR GREETING)
    // ==========================================
    const typingElement = document.querySelector('.sidebar-intro h2');

    if (typingElement) {
        const textToType = "Hello, I'm Lian!";
        typingElement.textContent = '';
        let i = 0;

        function typeWriter() {
            if (i < textToType.length) {
                typingElement.textContent += textToType.charAt(i);
                i++;
                setTimeout(typeWriter, 100);
            } else {
                typingElement.innerHTML = textToType + '<span class="cursor">|</span>';
            }
        }

        setTimeout(typeWriter, 500);
    }

    // ==========================================
    // 3. TECH STACK CAROUSEL
    // ==========================================
    const track = document.getElementById('carousel-track');

    if (track) {
        function rotateCarouselRight() {
            const lastItem = track.lastElementChild;

            track.style.transition = 'none';
            track.prepend(lastItem);
            track.style.transform = 'translateX(-100px)';

            setTimeout(() => {
                track.style.transition = 'transform 0.5s ease';
                track.style.transform = 'translateX(0)';
                updateCenter();
            }, 50);
        }

        function updateCenter() {
            const items = track.children;
            Array.from(items).forEach(item => item.classList.remove('active'));
            if (items[2]) {
                items[2].classList.add('active');
            }
        }

        updateCenter();
        setInterval(rotateCarouselRight, 2500);
    }

    // ==========================================
    // 4. SKILLS ACCORDION
    // ==========================================
    const accordions = document.querySelectorAll('.skill-category');

    if (accordions.length > 0) {
        accordions.forEach((acc, index) => {
            const header = acc.querySelector('h3');
            const ul = acc.querySelector('ul');

            if (index === 0) {
                acc.classList.add('active');
                ul.style.maxHeight = ul.scrollHeight + 'px';
            }

            header.addEventListener('click', () => {
                const isActive = acc.classList.contains('active');

                accordions.forEach(otherAcc => {
                    otherAcc.classList.remove('active');
                    otherAcc.querySelector('ul').style.maxHeight = '0px';
                });

                if (!isActive) {
                    acc.classList.add('active');
                    ul.style.maxHeight = ul.scrollHeight + 'px';
                }
            });
        });
    }

    // ==========================================
    // 5. FADE-IN ANIMATION
    // ==========================================
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
            }
        });
    }, { threshold: 0.1 });

    const elementsToFade = document.querySelectorAll('.section, .card, .skill-category, .project-card, .cert-card, .timeline-item');

    elementsToFade.forEach(element => {
        element.classList.add('fade-in');
        observer.observe(element);
    });

    // ==========================================
    // 6. FORM VALIDATION (INLINE ERRORS)
    // ==========================================
    const form = document.querySelector('.contact-form');
    const submitBtn = document.querySelector('.form-submit');

    if (form && submitBtn) {
        submitBtn.addEventListener('click', (e) => {
            const nameInput = document.querySelector('input[name="name"]');
            const emailInput = document.querySelector('input[name="email"]');
            const messageInput = document.querySelector('textarea[name="message"]');

            let isValid = true;

            function validateField(input, isInvalid) {
                if (!input) return;
                const wrapper = input.parentElement;
                if (isInvalid) {
                    wrapper.classList.add('error');
                    isValid = false;
                } else {
                    wrapper.classList.remove('error');
                }
            }

            validateField(nameInput, nameInput.value.trim() === '');
            validateField(messageInput, messageInput.value.trim() === '');
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            validateField(emailInput, !emailRegex.test(emailInput.value));

            if (!isValid) {
                e.preventDefault(); 
                
                submitBtn.style.transition = 'none';
                submitBtn.style.transform = 'translateX(-5px)';
                setTimeout(() => submitBtn.style.transform = 'translateX(5px)', 50);
                setTimeout(() => submitBtn.style.transform = 'translateX(-5px)', 100);
                setTimeout(() => submitBtn.style.transform = 'translateX(0)', 150);
                setTimeout(() => submitBtn.style.transition = 'opacity 0.2s ease, transform 0.2s ease', 200);
            } else {
                submitBtn.textContent = 'Sending...';
            }
        });
    }
});