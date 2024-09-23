export default class MediaUploader
{
  constructor(element, options) {
      this.defaults = {
          multiple: false,
          placeholder: '/wp-content/uploads/woocommerce-placeholder-240x240.png',
          title: 'Choose an image',
          buttonText: 'Use image',
          uploadButton: '.upload_image_button',
          removeButton: '.remove_image_button',
          imageIdField: '.image-id',
          imageContainerField: '.image-container',
      };

      this.settings = { ...this.defaults, ...options };
      this.element = element;
      this.fileFrame = null;

      this.init();
  }

  init() {
      this.cacheElements();
      this.updateRemoveButtonVisibility();
      this.bindEvents();
  }

  cacheElements() {
      this.imageIdField = this.element.querySelector(this.settings.imageIdField);
      this.removeButton = this.element.querySelector(this.settings.removeButton);
      this.uploadButton = this.element.querySelector(this.settings.uploadButton);
  }

  bindEvents() {
      this.uploadButton.addEventListener('click', (event) => this.openMediaFrame(event));
      this.removeButton.addEventListener('click', (event) => this.removeImage(event));
  }

  updateRemoveButtonVisibility() {
      this.removeButton.style.display = this.imageIdField.value ? 'block' : 'none';
  }

  openMediaFrame(event) {
      event.preventDefault();

      if (this.fileFrame) {
          this.fileFrame.open();
          return;
      }

      this.fileFrame = wp.media({
          title: this.settings.title,
          button: {
              text: this.settings.buttonText
          },
          multiple: this.settings.multiple
      });

      this.fileFrame.on('select', () => this.onImageSelect());

      this.fileFrame.open();
  }

  onImageSelect() {
      const selection = this.fileFrame.state().get('selection').toJSON();
      if (this.settings.multiple) {
          this.handleMultipleSelection(selection);
      } else {
          this.handleSingleSelection(selection[0]);
      }
      this.updateRemoveButtonVisibility();
  }

  handleMultipleSelection(selection) {
      const ids = selection.map(attachment => attachment.id);
      this.imageIdField.value = ids.join(',');

      const thumbnailUrls = selection.map(attachment =>
          attachment.sizes.thumbnail ? attachment.sizes.thumbnail.url : attachment.url
      );

      this.element.querySelectorAll(`${this.settings.imageContainerField} img`).forEach((img, index) => {
          if (thumbnailUrls[index]) {
              img.src = thumbnailUrls[index];
          }
      });
  }

  handleSingleSelection(attachment) {
      const attachmentThumbnail = attachment.sizes.thumbnail || attachment.sizes.full;

      this.imageIdField.value = attachment.id;
      this.element.querySelector(`${this.settings.imageContainerField} img`).src = attachmentThumbnail.url;
  }

  removeImage(event) {
      event.preventDefault();

      this.imageIdField.value = '';
      this.element.querySelector(`${this.settings.imageContainerField} img`).src = this.settings.placeholder;
      this.updateRemoveButtonVisibility();
  }
}
