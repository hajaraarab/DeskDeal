const easeOutCubic = x => 1 - Math.pow(1 - x, 3);

const animateCount = (element, target) => {
  const duration = 1200;
  const startTime = performance.now();

  const tick = now => {
    const elapsed = now - startTime;
    const progress = Math.min(elapsed / duration, 1);
    const currentValue = Math.floor(target * easeOutCubic(progress));
    element.textContent = currentValue.toLocaleString('nl-NL');

    if (progress < 1) {
      requestAnimationFrame(tick);
    }
  };

  requestAnimationFrame(tick);
};

const initCountdown = () => {
  const counters = document.querySelectorAll('.count-down h1');
  if (!counters.length) {
    return;
  }

  counters.forEach(counter => {
    const rawValue = counter.textContent.trim();
    const targetValue = parseInt(rawValue.replace(/\D/g, ''), 10);
    if (Number.isNaN(targetValue)) {
      return;
    }

    counter.textContent = '0';
    animateCount(counter, targetValue);
  });
};

document.addEventListener('DOMContentLoaded', initCountdown);

