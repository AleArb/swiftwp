function initializeSingleProduct()
{
  if ( !document.body.classList.contains('single-product') ) {
    return;
  }

  /**
   * Change product image when clicking on gallery thumbnails.
   */
  const singleProductImages = document.querySelector('.single-product__images');

  if ( singleProductImages ) {
    singleProductImages.addEventListener('click', (event) => {
      const carouselSlides = singleProductImages.querySelector('.carousel-slides');
      const thumbnail = event.target.closest('.carousel-thumbnails .item');
      const thumbnailActive = singleProductImages.querySelector('.carousel-thumbnails .item--active');
      const arrowLeft = event.target.closest('.carousel-arrow-left');
      const arrowRight = event.target.closest('.carousel-arrow-right');

      if ( thumbnail && thumbnail !== thumbnailActive ) {
        const thumbnailIndex = thumbnail.getAttribute('data-item-key');
        thumbnail.classList.add('item--active');
        thumbnailActive.classList.remove('item--active');
        carouselSlides.querySelector('.items').style.transform = `translateX(-${thumbnailIndex * 100}%)`;
      }

      if ( arrowLeft && thumbnailActive.previousSibling ) {
        const thumbnailActiveIndex = parseInt(thumbnailActive.getAttribute('data-item-key')) - 1;
        thumbnailActive.previousSibling.classList.add('item--active');
        thumbnailActive.classList.remove('item--active');
        carouselSlides.querySelector('.items').style.transform = `translateX(-${thumbnailActiveIndex * 100}%)`;
      }

      if ( arrowRight && thumbnailActive.nextSibling ) {
        const thumbnailActiveIndex = parseInt(thumbnailActive.getAttribute('data-item-key')) + 1;
        thumbnailActive.nextSibling.classList.add('item--active');
        thumbnailActive.classList.remove('item--active');
        carouselSlides.querySelector('.items').style.transform = `translateX(-${thumbnailActiveIndex * 100}%)`;
      }
    });
  }

  /**
   * Toggle product variation style popup.
   */
  const productVariationSelect = document.querySelectorAll('.singleProduct__variationSelect');

  if ( productVariationSelect ) {
    productVariationSelect.forEach(element => {
      const productVariationSelectDescription = element.querySelector('.description');
      const productVariationSelectPopup = element.querySelector('.popup');
      const productVariationSelectPopupOverlay = element.querySelector('.popup-overlay');
      const productVariationSelectPopupClose = element.querySelector('.icon-close');

      productVariationSelectDescription.addEventListener('click', () => {
        productVariationSelectPopup.classList.toggle('popup--active');
      });

      productVariationSelectPopupOverlay.addEventListener('click', () => {
        productVariationSelectPopup.classList.toggle('popup--active');
      });

      productVariationSelectPopupClose.addEventListener('click', () => {
        productVariationSelectPopup.classList.toggle('popup--active');
      });
    });
  }
}

document.addEventListener('DOMContentLoaded', initializeSingleProduct);