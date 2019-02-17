const csvUpload = document.querySelector('.upload-csv');
const xlsxUpload = document.querySelector('.upload-xslx');
const csvMime = 'text/csv';
const xlsxMime = 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet';

const validation = function validateUpload(mimeType) {
    return function () {
        const type = this.files[0].type;

        if (type !== mimeType) {
            this.parentElement.insertAdjacentHTML('beforebegin',
                '<span class="form-error">' + type.substring(type.indexOf("/") + 1)
                + ' is not allowed. Please upload ' + mimeType.substring(mimeType.indexOf("/") + 1) + ' only </span>');
        }
    }
};

xlsxUpload.addEventListener('input', validation(xlsxMime));
csvUpload.addEventListener('input', validation(csvMime));