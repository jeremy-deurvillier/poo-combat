function manageTimer() {
    let summonDateElm = document.querySelector('[data-summon]')
    let summonDate = (summonDateElm)?summonDateElm.innerHTML:null;

    if (summonDate !== null) {
        let timer = setInterval(() => {
            let summonDateElm = document.querySelector('[data-summon]')
            let summonDate = (summonDateElm)?summonDateElm.innerHTML:null;
            let m = parseInt(summonDate.split(':')[0]);
            let s = parseInt(summonDate.split(':')[1]);

            s = (s - 1 == -1)?59:s - 1;
            m = (s == 59)?m - 1:m;

            if (m == -1) {
                clearInterval(timer);
                let hero = parseInt(summonDateElm.dataset.hero);
                summonDateElm.parentNode.innerHTML = '<a href="live.php?precondition=true&hero=' + hero + '" class="btn btn-success">Conditionner</a>';
            } else {
                summonDateElm.innerHTML = ((m >= 10)?m:'0' + m) + ':' + ((s >= 10)?s:'0' + s);
            }
        }, 1000);
    }
}

function getInfosFight(action, datas) {
    let headers = new Headers();

    let options = {
        method: 'GET',
        headers: headers
    };

    let url = 'http://poo-combat.dev.local/api.php?fight=true&action=' + action + '&datas="' + JSON.stringify(datas) + '"';
    console.log(url);

    fetch(url)
    .then(result => result.json())
    .then((r) => console.log(r));
}

function fight(e) {
    let datas = getDatasFight();

    getInfosFight(e.target.dataset['action'], datas);
}

if (document.location.search == '' || document.location.search.indexOf('page=invoke') > -1) {
    manageTimer();
}

if (document.location.search.indexOf('page=fight') > -1) {
    let actions = document.querySelectorAll('a[data-action]');

    actions.forEach((btn) => btn.addEventListener('click', fight));
}
