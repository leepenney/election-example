<template>
    <div class="container-sm mt-3 mb-3">
        <div>
            <h1>How are you going to vote?</h1>
            <p>Please indicate whether you plan to vote in the upcoming general election, and if so, who you plan to vote for.</p>
        </div>
        <recordResponseForm />
    </div>
</template>

<script>
    import recordResponseForm from './recordResponseForm.vue'
    export default {
        components: {
            recordResponseForm
        }
    }
</script>

<style scoped>
</style>