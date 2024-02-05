document.addEventListener('DOMContentLoaded', function () {
    // Получаем элементы вкладок
    var tabs = document.querySelectorAll('.nav-link');

    // Добавляем обработчик события для каждой вкладки
    tabs.forEach(function (tab) {
        tab.addEventListener('click', function (event) {
            event.preventDefault();

            // Очищаем все активные вкладки и контент
            tabs.forEach(function (t) {
                t.classList.remove('active');
            });

            // Делаем текущую вкладку активной
            tab.classList.add('active');

            // Очищаем все активные контентные области
            var tabContents = document.querySelectorAll('.tab-pane');
            tabContents.forEach(function (content) {
                content.classList.remove('show', 'active');
            });

            // Получаем идентификатор целевой вкладки
            var targetId = tab.getAttribute('href').substring(1);

            // Делаем соответствующую контентную область активной
            var targetContent = document.getElementById(targetId);
            targetContent.classList.add('show', 'active');
        });
    });
});