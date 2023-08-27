(function(){

    let datas;

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

    function showFightResult(result) {
        console.log(result);
        let wrapper = document.createElement('div');
        let content = document.createElement('div');

        let elmStatus = document.createElement('p');
        let elmState = document.createElement('p');

        let textStatus = document.createTextNode(result['status']);
        let textState = document.createTextNode(result['state']);

        let classname = (result['victory'])?'success':'body-tertiary';

        wrapper.setAttribute('class', 'text-' + classname + ' text-center row mx-auto my-5');
        content.setAttribute('class', 'col-12');
        elmStatus.setAttribute('class', 'fs-4 my-4');
        elmState.setAttribute('class', 'fs-2 fw-bold border p-4');

        elmStatus.appendChild(textStatus);
        elmState.appendChild(textState);

        content.appendChild(elmStatus);
        content.appendChild(elmState);
        wrapper.appendChild(content);
        document.querySelector('#fightHistory').appendChild(wrapper);

        document.querySelector('#userActions').parentNode.removeChild(document.querySelector('#userActions'));
    }

    function showFightStep(steps) {
        let heroHit = true;

        steps.forEach((step) => {
            let wrapper = document.createElement('div');
            let content = document.createElement('div');

            let elmStatus = document.createElement('p');
            let elmState = document.createElement('p');

            let textStatus = document.createTextNode(step['status']);
            let textState = document.createTextNode(step['state']);

            let classname = (heroHit)?'info text-end':'danger';

            wrapper.setAttribute('class', 'text-' + classname + ' row border-bottom mx-auto my-3');
            content.setAttribute('class', 'col-12');
            elmState.setAttribute('class', 'fw-bold');

            elmStatus.appendChild(textStatus);
            elmState.appendChild(textState);

            content.appendChild(elmStatus);
            content.appendChild(elmState);
            wrapper.appendChild(content);
            document.querySelector('#fightHistory').appendChild(wrapper);

            heroHit = !heroHit;
        });
    }

    function getInfosFight(action, datas) {
        let headers = new Headers();

        let options = {
            method: 'GET',
            headers: headers
        };

        let url = 'http://poo-combat.dev.local/api.php?action=' + action + '&hero=' + datas['hero'] + '&monster=' + encodeURI(datas['monster']['name']) + '&hp=' + datas['monster']['hp'];
        console.log(url);

        fetch(url)
        .then(result => result.json())
        .then((steps) => {
            showFightStep(steps['steps'])

            if (Object.keys(steps['result']).length > 0) showFightResult(steps['result']['result']);

            datas['monster']['hp'] = steps['hpM'];
        });
    }

    function fight(e) {
        e.preventDefault();

        getInfosFight(e.target.dataset['action'], datas);
    }

    if (document.location.search == '' || document.location.search.indexOf('page=invoke') > -1) {
        manageTimer();
    }

    if (document.location.search.indexOf('page=fight') > -1) {
        datas = getDatasFight();

        let actions = document.querySelectorAll('a[data-action]');

        actions.forEach((btn) => btn.addEventListener('click', fight));
    }
})();
