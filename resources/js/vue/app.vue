<template>
    <div class="container-sm mt-3 mb-3" v-if="showForm">
        <div>
            <h1>How are you going to vote?</h1>
            <p>Please indicate whether you plan to vote in the upcoming general election, and if so, who you plan to vote for.</p>
        </div>
        <recordResponseForm @submitted="submitted" />
    </div>
    <div class="container-sm mt-3 mb-3" v-else-if="!showForm">
        <div>
            <h1>Thanks, we have recorded your response.</h1>
            <a href="/results" class="btn btn-primary mt-5">See the results</a>
        </div>
    </div>
</template>

<script>
    import recordResponseForm from './recordResponseForm.vue'
    export default {
        components: {
            recordResponseForm
        },
        data: () => {
            return {
                showForm: true
            }
        },
        methods: {
            submitted: function() {
                this.showForm = false;
            }
        }
    }
</script>

<style scoped>
</style>