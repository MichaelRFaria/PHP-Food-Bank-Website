function sendEmail() {
  const element = document.getElementById("input_form");
  element.remove();

  const subtitle = document.getElementById("subtitle");
  subtitle.textContent = "E-mail submitted!";

  const message = document.getElementById("instructions");
  message.textContent =
    "Thank you for submitting your message. Our team will get back to you shortly.";

  const images = document.getElementById("invisible_images");
  images.id = "visible_images";
}
