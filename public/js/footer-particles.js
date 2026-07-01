(function () {
    'use strict';

    function initFooterParticles() {
        var canvas = document.getElementById('footer-particles');
        var footer = canvas ? canvas.closest('.site-footer-modern') : null;

        if (!canvas || !footer) {
            return;
        }

        var ctx = canvas.getContext('2d');
        var particles = [];
        var animationId = null;
        var width = 0;
        var height = 0;
        var particleCount = 48;

        function random(min, max) {
            return Math.random() * (max - min) + min;
        }

        function createParticles() {
            particles = [];

            for (var i = 0; i < particleCount; i++) {
                particles.push({
                    x: random(0, width),
                    y: random(0, height),
                    radius: random(1, 2.4),
                    speedX: random(-0.25, 0.25),
                    speedY: random(-0.35, -0.05),
                    alpha: random(0.15, 0.55),
                });
            }
        }

        function resize() {
            width = footer.offsetWidth;
            height = footer.offsetHeight;
            canvas.width = width;
            canvas.height = height;

            var density = Math.max(28, Math.round((width * height) / 18000));
            particleCount = Math.min(density, 72);
            createParticles();
        }

        function draw() {
            ctx.clearRect(0, 0, width, height);

            particles.forEach(function (particle) {
                particle.x += particle.speedX;
                particle.y += particle.speedY;

                if (particle.x < -10) {
                    particle.x = width + 10;
                } else if (particle.x > width + 10) {
                    particle.x = -10;
                }

                if (particle.y < -10) {
                    particle.y = height + 10;
                } else if (particle.y > height + 10) {
                    particle.y = -10;
                }

                ctx.beginPath();
                ctx.arc(particle.x, particle.y, particle.radius, 0, Math.PI * 2);
                ctx.fillStyle = 'rgba(227, 30, 36, ' + particle.alpha + ')';
                ctx.fill();
            });

            particles.forEach(function (a, index) {
                for (var bIndex = index + 1; bIndex < particles.length; bIndex++) {
                    var b = particles[bIndex];
                    var dx = a.x - b.x;
                    var dy = a.y - b.y;
                    var distance = Math.sqrt(dx * dx + dy * dy);

                    if (distance < 110) {
                        ctx.beginPath();
                        ctx.moveTo(a.x, a.y);
                        ctx.lineTo(b.x, b.y);
                        ctx.strokeStyle = 'rgba(227, 30, 36, ' + (0.12 * (1 - distance / 110)) + ')';
                        ctx.lineWidth = 1;
                        ctx.stroke();
                    }
                }
            });

            animationId = window.requestAnimationFrame(draw);
        }

        function destroy() {
            if (animationId) {
                window.cancelAnimationFrame(animationId);
            }
        }

        resize();
        draw();

        window.addEventListener('resize', resize);
        window.addEventListener('beforeunload', destroy);
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initFooterParticles);
    } else {
        initFooterParticles();
    }
})();
