window.addEventListener('DOMContentLoaded', function() {

    //Калькулятор для пасчётов удобрений на урожай от 2500 кг/га

    let nitrogenSelect = document.getElementById('nitrogen_select'),
        phosphorusSelect = document.getElementById('phosphorus_select'),
        potassiumSelect = document.getElementById('potassium_select'),
        nitrogenBtn = document.querySelectorAll('.compute')[0],
        phosphorusBtn = document.querySelectorAll('.compute')[1],
        potassiumBtn = document.querySelectorAll('.compute')[2],
        nitrogenInput = document.getElementsByTagName('input')[0],
        phosphorusInput = document.getElementsByTagName('input')[1],
        potassiumInput = document.getElementsByTagName('input')[2],
        nitrogenCultor = document.getElementById('n-cultor'),
        phosphorusCultor = document.getElementById('ph-cultor'),
        potassiumCultor = document.getElementById('k-cultor'),
        nitrogenSoil = document.getElementById('n-soil'),
        phosphorusSoil = document.getElementById('ph-soil'),
        potassiumSoil = document.getElementById('k-soil'),
        nitrogen = document.getElementById('nitrogen'),
        phosphorus = document.getElementById('phosphorus'),
        potassium = document.getElementById('potassium'),
        total = 0,
        nitrogenValue = 0,
        phosphorusValue = 0,
        potassiumValue = 0;
    const n = 27,
        km = 26.45,
        ph = 6,
        k = 8,
        nFert = 53,
        phFert = 15,
        kFert = 84;

    nitrogen.innerHTML = '0 ц/га';
    phosphorus.innerHTML = '0 ц/га';
    potassium.innerHTML = '0 ц/га';

    nitrogenBtn.onclick = function() {
        if(nitrogenInput.value == '') {
            nitrogen.innerHTML = 'Ошибка!';
        } else if(nitrogenInput.value < 26) {
            nitrogen.innerHTML = 'Планируемый урожай должен<br> быть больше 25 ц/га';
        } else {
            total = ((100 * nitrogenCultor.options[nitrogenCultor.selectedIndex].value * nitrogenInput.value)-(nitrogenSoil.options[nitrogenSoil.selectedIndex].value * n * km))/(nFert * nitrogenSelect.options[nitrogenSelect.selectedIndex].value);
            let a = total;
            nitrogenValue = a.toFixed(2) + ' ц/га';
            nitrogen.innerHTML = nitrogenValue;
        }
    };

    phosphorusBtn.onclick = function() {
        if(phosphorusInput.value == '') {
            phosphorus.innerHTML = 'Ошибка!';
        } else if(phosphorusInput.value < 26) {
            phosphorus.innerHTML = 'Планируемый урожай должен<br> быть больше 25 ц/га';
        } else {
            total = ((100 * phosphorusCultor.options[phosphorusCultor.selectedIndex].value * phosphorusInput.value)-(phosphorusSoil.options[phosphorusSoil.selectedIndex].value * ph * km))/(phFert * phosphorusSelect.options[phosphorusSelect.selectedIndex].value);
            let b = total;
            phosphorusValue = b.toFixed(2) + ' ц/га';
            phosphorus.innerHTML = phosphorusValue;
        }
    };

    potassiumBtn.onclick = function() {
        if(potassiumInput.value == '') {
            potassium.innerHTML = 'Ошибка!';
        } else if(potassiumInput.value < 26) {
            potassium.innerHTML = 'Планируемый урожай должен<br> быть больше 25 ц/га';
        } else {
            total = ((100 * potassiumCultor.options[potassiumCultor.selectedIndex].value * potassiumInput.value)-(potassiumSoil.options[potassiumSoil.selectedIndex].value * k * km))/(kFert * potassiumSelect.options[potassiumSelect.selectedIndex].value);
            let c = total;
            potassiumValue = c.toFixed(2) + ' ц/га';
            potassium.innerHTML = potassiumValue;
        }
    }; 
    //Калькулятор для малых расчётов (JQuery script)

    $('.nitr')[0].innerHTML = '0 гр';
    $('.phsu')[0].innerHTML = '0 гр';
    $('.ksi')[0].innerHTML = '0 гр';

    $('.nBtn').on('click', function() {
        if($('#ni')[0].value != 0 && $('#ni')[0].value != '') {
            let N = ($('#ni')[0].value * 100)/$('#ns')[0].options[$('#ns')[0].selectedIndex].value;
            $('.nitr')[0].innerHTML = Math.round(N) + ' гр/м<sup>2</sup>'; 
        } else {
            $('.nitr')[0].innerHTML = 'Ошибка!'; 
        };
    });
    $('.phBtn').on('click', function() {
        if($('#phi')[0].value != 0 && $('#phi')[0].value != '') {
            let Ph = ($('#phi')[0].value * 100)/$('#phs')[0].options[$('#phs')[0].selectedIndex].value;
            $('.phsu')[0].innerHTML = Math.round(Ph) + ' гр/м<sup>2</sup>';; 
        } else {
            $('.phsu')[0].innerHTML = 'Ошибка!'; 
        };
    });
    $('.kBtn').on('click', function() {
        if($('#ki')[0].value != 0 && $('#ki')[0].value != '') {
            let K = ($('#ki')[0].value * 100)/$('#ks')[0].options[$('#ks')[0].selectedIndex].value;
            $('.ksi')[0].innerHTML = Math.round(K)  + ' гр/м<sup>2</sup>';; 
        } else {
            $('.ksi')[0].innerHTML = 'Ошибка!'; 
        };
    });
});

