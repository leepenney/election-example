<template>
    <div id="votes-by-constituency" class="row">
        <div v-for="(parties, constituency) in votesByConst" class="col-sm-4">
            <h3>{{ constituency }}</h3>
            <table cellspacing="0" cellpadding="0" border="0" class="table table-striped table-sm">
                <thead class="thead-dark">
                    <tr>
                        <th>Party</th>
                        <th>Indicated Votes</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="party in parties.parties">
                        <td>{{ party.party }}</td>
                        <td>{{ party.votes }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
    export default {
        data: () => {
            return {
                votes: []
            }
        },
        methods: {
            getResponsesByConstituency() {
                axios.get('api/responses/x')
                .then( response => {
                    this.votes = response.data
                })
                .catch( error => {
                    console.log('Error retrieving responses')
                })
            }
        },
        computed: {
            votesByConst: function() {
                let jsonOut = new Object;
                this.votes.forEach((row) => {
                    if (!(jsonOut.hasOwnProperty(row['c_name']))) {
                        jsonOut[row['c_name']] = {'parties': []};
                    }
                    let partyVotes = new Object;
                    partyVotes['party'] = row['p_name'];
                    partyVotes['votes'] = row['votes'] ? row['votes'] : 0;
                    jsonOut[row['c_name']]['parties'].push(partyVotes);
                    jsonOut[row['c_name']]['parties'].sort((a, b) => {
                        let fa = a.party.toLowerCase(),
                            fb = b.party.toLowerCase();

                        if (fa < fb) {
                            return -1;
                        }
                        if (fa > fb) {
                            return 1;
                        }
                        return 0;
                        });
                });
                return jsonOut;
            }
        },
        created() {
            this.getResponsesByConstituency();
        }
    }
</script>

<style scoped>
    tr > th:nth-child(2),
    tr > td:nth-child(2) {
	    text-align: center;
    }
</style>