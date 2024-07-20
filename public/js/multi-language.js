document.querySelectorAll('.localesTranslateTabs li').forEach((li) => {
    li.addEventListener('click', (e) => {


        document.querySelectorAll('.localesTranslateTabs li').forEach((item) => {
            item.querySelector('a').classList.remove('text-sky-600');
        });
        document.querySelectorAll('.localesTranslateContent .tabsChild').forEach((item) => {
            item.classList.add('hidden');
            item.classList.remove('block');
        });


        document.querySelector(li.getAttribute('data-parent')).classList.add('block');
        document.querySelector(li.getAttribute('data-parent')).classList.remove('hidden');

        e.target.classList.add('text-sky-600');
    });
});

