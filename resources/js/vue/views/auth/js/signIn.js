import { reactive, ref } from "vue";
import { callApi } from "../../../helpers/services/callApi";

export function useSignIn() {

    const signInFormRef = ref(null);
    const isLoading = ref(false);

    const formValidate = reactive({
        email: '',
        password: '',
    });

    const ruleValidate = reactive({
        email: [
            { required: true, message: 'Please input your email', trigger: 'blur' },
            { type: 'email', message: 'Please input a valid email', trigger: 'blur' },
        ],
        password: [
            { required: true, message: 'Please input your password', trigger: 'blur' },
            { min: 6, message: 'Password must be at least 6 characters', trigger: 'blur' },
        ],
    });

    const signIn = async () => {

        signInFormRef.value.validate(async (valid) => {
            if (valid) {
                isLoading.value = true;
                const res = await callApi("POST", "/admin/auth/login", formValidate);
                if (res.data.success) {
                    window.location.reload();
                }
                isLoading.value = false;
            }
        });
    };

    return {
        formValidate,
        ruleValidate,
        signInFormRef,
        signIn,
        isLoading
    };

}
