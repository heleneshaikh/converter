const csvUpload = document.querySelector('.button__input--csv');
const xlsxUpload = document.querySelector('.button__input--xlsx');
const csvMime = 'text/csv';
const xlsxMime = 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet';
const uploadForm = document.querySelector('.form');

const validation = function validateUpload(mimeType) {
    return function () {
        const type = this.files[0].type;

        if (type !== mimeType) {
            this.parentElement.insertAdjacentHTML('afterend',
                '<span class="form-error">' + type.substring(type.indexOf("/") + 1)
                + ' is not allowed. Please upload ' + mimeType.substring(mimeType.indexOf("/") + 1) + ' only </span>');
        } else {
            // document.querySelector('span.form-error').classList.remove();
            uploadForm.submit();
        }
    }
};

xlsxUpload.addEventListener('input', validation(xlsxMime));
csvUpload.addEventListener('input', validation(csvMime));