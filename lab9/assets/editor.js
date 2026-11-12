function attachEditor(element) {
  if (!window.CKEDITOR) return;
  const {ClassicEditor, Essentials, Paragraph, Heading, Bold, Italic, Link, List, BlockQuote, Undo} = CKEDITOR;
  ClassicEditor.create(element, {
    licenseKey: 'GPL', plugins: [Essentials, Paragraph, Heading, Bold, Italic, Link, List, BlockQuote, Undo],
    toolbar: ['undo', 'redo', '|', 'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote']
  }).catch(error => { console.error(error); });
}
