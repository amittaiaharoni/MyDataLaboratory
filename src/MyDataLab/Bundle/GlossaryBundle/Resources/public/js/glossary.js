var MDL = {};
MDL.slugify = function slugify(text) {
    return text.toLowerCase()
        .replace(/\s+/g, '-') // Replace spaces with -
        .replace(/[^\w\-]+/g, '')// Remove all non-word chars
        .replace(/\-\-+/g, '-')// Replace multiple - with single -
        .replace(/^-+/, '')// Trim - from start of text
        .replace(/-+$/, '');// Trim - from end of text
};
document.getElementById('slugify_insert_text').innerHTML = MDL.slugify(document.getElementById('mydatalab_bundle_glossarybundle_definition_slug').value);
document.getElementById('mydatalab_bundle_glossarybundle_definition_slug').addEventListener('input', function () {
    document.getElementById('slugify_insert_text').innerHTML = MDL.slugify(document.getElementById('mydatalab_bundle_glossarybundle_definition_slug').value);
});