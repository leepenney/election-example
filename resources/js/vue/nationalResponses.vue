<template>
    <table cellspacing="0" cellpadding="0" border="0" class="table table-striped">
        <thead class="thead-dark">
            <tr>
                <th>Party</th>
                <th>Indicated Votes</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="party in parties">
                <td>{{ party.p_name }}</td>
                <td>{{ party.votes }}</td>
            </tr>
        </tbody>
    </table>
</template>

<script>
    export default {
        data: () => {
            return {
                parties: []
            }
        },
        methods: {
            getNationalResponses() {
                axios.get('api/responses/all')
                .then( response => {
                    this.parties = response.data
                })
                .catch( error => {
                    console.log('Error retrieving responses')
                })
            }
        },
        created() {
            this.getNationalResponses();
        }
    }
</script>