import { Notice } from "view-ui-plus";

export const infoMsg = (msg, i = "Hey !") => {
   return Notice.info({
        title: i,
        desc: msg + ' ℹ️ℹ️',
    });
};
export const successMsg = (msg, i = "Great!") => {
   return Notice.success({
        title: i,
        desc: msg + ' 🎉😊🔥',
    });
};
export const warningMsg = (msg, i = "Hey!") => {
   return Notice.warning({
        title: i,
        desc: msg + ' ⚠️⚠️⚠️',
    });
};
export const errorMsg = (msg, i = "Oops!") => {
   return Notice.error({
        title: i,
        desc: msg + ' 😔😔',
    });
};
export const swrMsg = () => {
   return Notice.error({
        title: "Oops",
        desc: "Something went wrong, please try again later. 😔😔",
    });
};

export const formValidationFailedMsg = () => {
   return warningMsg('Please fill form correctly.');
}


