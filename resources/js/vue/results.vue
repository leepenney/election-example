<template>
    <div class="container-sm mt-3 mb-3">
        <div>
            <h1>Responses Summary</h1>
            <p>This page shows a summary of the responses we have recorded.</p>
        </div>
        <div class="responses national col mt-5">
            <nationalResponses />
        </div>
        <div class="responses by-const col mt-5">
            <responsesByConst />
        </div>
    </div>
</template>

<script>
    import nationalResponses from './nationalResponses.vue';
    import responsesByConst from './responsesByConst.vue';
    export default {
        components: {
            nationalResponses,
            responsesByConst
        }
    }
</script>

<style>
    tr > th:nth-child(2), tr > td:nth-child(2) {
        text-align: center;
    }
</style>