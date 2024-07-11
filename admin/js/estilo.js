document.addEventListener('DOMContentLoaded', function () {
    var selectVidro = document.getElementById('idServicosVidro');
    var selectEsquadria = document.getElementById('idServicosEsquadria');

    function toggleSelects() {
        if (selectVidro.value !== '') {
            selectEsquadria.disabled = true;
            selectEsquadria.removeAttribute('required');
            selectEsquadria.value = '';
        } else {
            selectEsquadria.disabled = false;
            selectEsquadria.setAttribute('required', 'required');
        }

        if (selectEsquadria.value !== '') {
            selectVidro.disabled = true;
            selectVidro.removeAttribute('required');
            selectVidro.value = '';
        } else {
            selectVidro.disabled = false;
            selectVidro.setAttribute('required', 'required');
        }
    }

    selectVidro.addEventListener('change', toggleSelects);
    selectEsquadria.addEventListener('change', toggleSelects);
});
