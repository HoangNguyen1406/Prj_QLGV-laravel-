
    const tabs = {};

    function openTab(key, url) {
        //active tab
        if (tabs[key]) {
            activateTab(key);
            return;
        }

        //
        const tabButton = document.createElement('button');
        tabButton.classList.add('tab-button');
        tabButton.id = `tab-btn-${key}`;
        tabButton.innerHTML = key.replace(/-/g, ' ').toUpperCase();

        const closeBtn = document.createElement('span');
        closeBtn.innerHTML = '×';
        closeBtn.classList.add('tab-close');
        closeBtn.onclick = function (e) {
            e.stopPropagation();
            removeTab(key);
        };

        tabButton.appendChild(closeBtn);
        tabButton.onclick = () => activateTab(key);
        document.getElementById('tab-bar').appendChild(tabButton);

        tabs[key] = { url };

        activateTab(key);
    }

    function activateTab(key) {
        document.querySelectorAll('.tab-button').forEach(btn => btn.classList.remove('active'));
        const btn = document.getElementById(`tab-btn-${key}`);
        if (btn) btn.classList.add('active');

        fetch(tabs[key].url)
            .then(res => res.text())
            .then(html => {
                const parser = new DOMParser();
                const doc = parser.parseFromString(html, 'text/html');
                const content = doc.getElementById('page-content');
                document.getElementById('tab-content').innerHTML = content ? content.innerHTML : 'Không thể tải nội dung.';
            })
            .catch(err => {
                document.getElementById('tab-content').innerHTML = '<p>Lỗi khi tải nội dung.</p>';
            });
    }

    function removeTab(key) {
        delete tabs[key];
        const btn = document.getElementById(`tab-btn-${key}`);
        if (btn) btn.remove();
        document.getElementById('tab-content').innerHTML = '<p>Đã đóng tab.</p>';
    }