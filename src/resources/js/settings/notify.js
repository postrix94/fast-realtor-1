import iziToast from "izitoast";

iziToast.settings({
    theme: 'dark',
    close: true,
    position: "topRight",
    transitionIn: "fadeInDown",
    transitionOut: "fadeOutUp",

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

