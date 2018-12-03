<template>
    <card class="validation-error-list" v-if="length">
        <template slot="title">
            <span class="validation-error-title">Validation errors</span>
        </template>

        <template v-for="errorList in errors">
            <ul>
                <li v-for="errorItem in errorList">
                    {{ errorItem }}
                </li>
            </ul>
        </template>
    </card>

</template>

<script>
    export default {
        name: "ValidationErrorList",
        props: {
            errors: {
                type: Object,
                default: function () {
                    return {}
                }
            },
        },
        computed: {
            length() {
                return Object.keys(this.errors).length;
            }
        }
    }
</script>

<style scoped>
    .validation-error-title {
        color: red;
    }

    .validation-error-list {
        margin-bottom: 15px;
    }
</style>