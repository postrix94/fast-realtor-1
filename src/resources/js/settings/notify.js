import iziToast from "izitoast";

iziToast.settings({
    theme: 'light',
    close: true,
    position: "topRight",
    transitionIn: "fadeInDown",
    transitionOut: "fadeOutUp",
    timeout: 3000,
    displayMode: "once",
});


function successNotify(message, title = "") {
    iziToast.success({
        title,
        message,
    });
}

function errorNotify(message, title = "") {
    iziToast.error({
        title,
        message,
    });
}

function infoNotify(message, title = "") {
    iziToast.info({
        title,
        message,
    });
}

function warningNotify(message, title = "") {
    iziToast.warning({
        title,
        message,
    });
}

export {iziToast, successNotify, errorNotify, infoNotify, warningNotify};

