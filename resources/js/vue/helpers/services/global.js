
import { Modal } from "view-ui-plus";
import { infoMsg } from "./message";
import { useMainStore } from '@/vue/store';
import { lowerCase, upperFirst } from "lodash";

export const baseUrl = window.baseUrl;
export const defaultImg = (baseUrl + 'assets/images/blank_image.svg');

export const useSearch = () => {
    const storeMain = useMainStore();

    const onSearch = (callback) => {
        if (!storeMain.params.searchTxt) return infoMsg('Please enter some text!');
        storeMain.params.page = 1;
        callback();
    }

    const onClear = (callback) => {
        if (storeMain.params.searchTxt) return;
        storeMain.params.page = 1;
        callback();
    }

    return {
        onSearch,
        onClear
    }
}

export const jsonString = (value) => {
    if (!value) return value;
    return JSON.stringify(value);
}

export const jsonParse = (value) => {
    if (!value) return value;
    return JSON.parse(value);
}

export const parseString = (value) => {
    if (!value) return value;
    return JSON.parse(JSON.stringify(value));
}

export const toCapitalizeCase = (txt) => {
    if (!txt) return txt;
    return upperFirst(lowerCase(txt));
}

export const addUrl = (img) => {
    if (!img) return defaultImg;
    return (baseUrl + img);
}

export const confirmModal = (msgTxt, onOkCallback, cancelCallback = (() => {})) => {
    Modal.confirm({
        title: 'Warning',
        okText: 'Yes',
        cancelText: 'Cancel',
        content: msgTxt,
        onOk: async () => {
            onOkCallback(true);
        },
        onCancel: async () => {
            cancelCallback(true)
        }
    });
}


