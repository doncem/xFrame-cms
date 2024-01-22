document.addEventListener('DOMContentLoaded', () => {
  // forms
  let tabsWithContent = (function () {
    let tabs = document.querySelectorAll('.tabs li');
    let tabsContent = document.querySelectorAll('.tab-content');

    let deactvateAllTabs = function () {
      tabs.forEach(function (tab) {
        tab.classList.remove('is-active');
      });
    };

    let hideTabsContent = function () {
      tabsContent.forEach(function (tabContent) {
        tabContent.classList.add('is-hidden');
      });
    };

    let activateTabsContent = function (tab) {
      tabsContent[getIndex(tab)].classList.remove('is-hidden');
    };

    let getIndex = function (el) {
      return [...el.parentElement.children].indexOf(el);
    };

    tabs.forEach(function (tab) {
      tab.addEventListener('click', function () {
        deactvateAllTabs();
        hideTabsContent();
        tab.classList.add('is-active');
        activateTabsContent(tab);
      });
    })

    document.querySelectorAll('.tabs li:not(.is-active)')[0].click();
  })();

  // ajax
  async function postData(url = "", data = {}) {
    // Default options are marked with *
    const response = await fetch(url, {
      method: "POST", // *GET, POST, PUT, DELETE, etc.
      mode: "cors", // no-cors, *cors, same-origin
      cache: "no-cache", // *default, no-cache, reload, force-cache, only-if-cached
      credentials: "same-origin", // include, *same-origin, omit
      headers: {
        "Content-Type": "application/json",
      },
      redirect: "follow", // manual, *follow, error
      referrerPolicy: "no-referrer", // no-referrer, *no-referrer-when-downgrade, origin, origin-when-cross-origin, same-origin, strict-origin, strict-origin-when-cross-origin, unsafe-url
      body: JSON.stringify(data), // body data type must match "Content-Type" header
    });

    return response.json(); // parses JSON response into native JavaScript objects
  }
});
