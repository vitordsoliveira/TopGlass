document.addEventListener('DOMContentLoaded', function () {
    var selectVidro = document.getElementById('servicosVidro');
    var selectEsquadria = document.getElementById('servicosEsquadria');

    function toggleSelects() {
        if (selectVidro.value !== '') {
            selectEsquadria.disabled = true;
            selectEsquadria.value = '';
        } else {
            selectEsquadria.disabled = false;
        }

        if (selectEsquadria.value !== '') {
            selectVidro.disabled = true;
            selectVidro.value = '';
        } else {
            selectVidro.disabled = false;
        }
    }

    selectVidro.addEventListener('change', toggleSelects);
    selectEsquadria.addEventListener('change', toggleSelects);
});