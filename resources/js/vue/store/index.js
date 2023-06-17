import { defineStore } from "pinia";

const authUser = window.authUser ? window.authUser : null;
export const useMainStore = defineStore({
    id: 'main',
    state: () => ({
        authUser : authUser,
        isModal : false,
        isModal2 : false,
        isModal3 : false,
        dataLoading : false,
        dataList : [],
        dataListTwo: [],
        params: {
            searchTxt: '',
            page: 1,
            pageSize: 10,
        }
    }),

    getters: {
        getDataList: (state) => {
            return state.dataList;
        },
        getDataListTwo: (state) => {
            return state.dataListTwo;
        },
    },

    actions: {
        setAuthUser(data) {
            this.authUser = data;
        },
        setDataLoading(value) {
            this.dataLoading = value;
        },
        setDataToList(data) {
            this.dataList = data;
        },
        setDataToListTwo(data) {
            this.dataListTwo = data;
        },
        pushDataToList(dataObj) {
            this.dataList.data.unshift(dataObj);
            this.dataList.total += 1;
        },
        replaceWithUpdatedData(dataObj) {
            let index = this.dataList.data.findIndex(item => item.id == dataObj.id);
            this.dataList.data.splice(index, 1, dataObj);
        },
        pushDataToListTwo(dataObj) {
            this.dataListTwo.data.unshift(dataObj);
            this.dataListTwo.total += 1;
        },
        replaceWithUpdatedDataTwo(dataObj) {
            let index = this.dataListTwo.data.findIndex(item => item.id == dataObj.id);
            this.dataListTwo.data.splice(index, 1, dataObj);
        }
    }

});
