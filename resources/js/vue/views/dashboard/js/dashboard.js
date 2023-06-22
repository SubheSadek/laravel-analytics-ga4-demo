import { reactive } from "vue";
import { callApi } from "../../../helpers/services/callApi"
import { useMainStore } from '../../../store';
const storeMain = useMainStore();
export const useDashboard = () => {
    const analyticsData = reactive({
        'labels': [],
        'data': [],
    });
    const getStatistics = async () => {
        storeMain.setDataLoading(true);
        const res = await callApi('GET', '/admin/dashboard/get-analytics');
        if (res.data.success) {
            const statsData = res.data.json_data;
            analyticsData.labels = statsData.labels;
            analyticsData.data = statsData.data;
        }
        setTimeout(() => {
            storeMain.setDataLoading(false);
        },200)

    }

    return {
        storeMain,
        analyticsData,
        getStatistics,
    }
}
