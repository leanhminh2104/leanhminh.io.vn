!function () {
  const CDN_ASSETS = 'https://cdn.jsdelivr.net/gh/leanhminh2104/leanhminh.io.vn@main/assets';
  const scriptSrc = document.currentScript && document.currentScript.src ? document.currentScript.src : '';
  const isCdn = scriptSrc.includes('cdn.jsdelivr.net/gh/leanhminh2104/leanhminh.io.vn');
  const assetBase = isCdn ? CDN_ASSETS : './assets';

  const style = document.createElement('style');
  style.textContent = `
    .pixel-pet{position:fixed;left:0;bottom:10px;z-index:60;width:88px;height:88px;pointer-events:none;filter:drop-shadow(0 8px 10px rgb(0 0 0/.35));animation:pixelPetWalk 18s linear infinite,pixelPetHop .72s ease-in-out infinite}
    .pixel-pet lottie-player{width:100%;height:100%}
    @keyframes pixelPetWalk{0%{transform:translateX(-110px) scaleX(1)}49%{transform:translateX(calc(100vw + 20px)) scaleX(1)}50%{transform:translateX(calc(100vw + 20px)) scaleX(-1)}99%{transform:translateX(-110px) scaleX(-1)}100%{transform:translateX(-110px) scaleX(1)}}
    @keyframes pixelPetHop{0%,100%{margin-bottom:0}50%{margin-bottom:9px}}
    @media (max-width:640px){.pixel-pet{width:68px;height:68px;bottom:8px}}
  `;
  document.head.appendChild(style);

  function loadPlayer() {
    return new Promise(resolve => {
      if (customElements.get('lottie-player')) {
        resolve();
        return;
      }

      const script = document.createElement('script');
      script.src = 'https://unpkg.com/@lottiefiles/lottie-player@2.0.12/dist/lottie-player.js';
      script.onload = resolve;
      document.head.appendChild(script);
    });
  }

  loadPlayer().then(() => {
    const pet = document.createElement('div');
    pet.className = 'pixel-pet';
    pet.innerHTML = `<lottie-player src="${assetBase}/lottie/pixel-pet.json" background="transparent" speed="1" loop autoplay></lottie-player>`;
    document.body.appendChild(pet);
  });
}();
