<template>
    <div id="response-form">
        <form id="response" v-on:submit.prevent="recordResponse" v-if="showForm">
            <div class="col mb-5">
                <label for="constituency" class="form-label">Which constituency do you live in?</label>
                <p class="small">If you don't know your constituency, 
                    you can <a href="https://members.parliament.uk/constituencies" target="_blank">use this tool</a> to look it up.</p>
                <input @click="showConstituences = true" type="text" id="constituency" name="constituency" 
                    v-model="searchQuery" class="custom-select" placeholder="Search for your constituency">
                <ul v-show="showConstituences">
                    <li @click="selectConstituency(constituency)" v-for="constituency in filteredConstituences" v-bind:data-cid="constituency.c_id" :key="constituency.c_id">{{ constituency.c_name }}</li>
                </ul>
                <!--<select v-model="constituency_selected" id="constituency" required class="form-select form-select-lg">
                    <option disabled value="">Please select a constituency</option>
                    <option v-for="constituency in constituencies" v-bind:value="constituency.c_id">
                        {{ constituency.c_name }}
                    </option>
                </select>-->
            </div>

            <div class="col mb-5">
                <p>Are you going to vote?</p>

                <div class="form-check">
                    <input type="radio" id="voting_yes" value="1" name="voting" class="form-check-input" required v-model="voting" 
                        v-on:click="showPartyDropdown = true" />
                    <label for="voting_yes" class="form-check-label">Yes</label>
                </div>

                <div class="form-check mb-5">
                    <input type="radio" id="voting_no" value="0" name="voting" class="form-check-input" v-model="voting" v-on:click="showPartyDropdown = false" />
                    <label for="voting_no" class="form-check-label">No</label>
                </div>
            </div>

            <div class="col mb-5" v-show="showPartyDropdown">
                <label for="party" class="form-label">Who are you going to vote for?</label>
                <select v-model="party_selected" id="party" :required="showPartyDropdown ? true : false" class="custom-select d-block">
                    <option disabled value="">Please select a party</option>
                    <option v-for="party in parties" v-bind:value="party.p_id">
                        {{ party.p_name }}
                    </option>
                    <option value="99">Other</option>
                </select>
            </div>

            <div class="col mb-5">
                <input type="submit" value="Let Us Know" class="btn btn-primary mb-3" />
            </div>
        </form>
    </div>
</template>

<script>
    import axios from 'axios'

    export default {
        data: () => {
            return {
                constituency_selected: '',
                constituencies: [],
                party_selected: '',
                parties: [],
                voting: '',
                showForm: true,
                showPartyDropdown: false,
                showConstituences: false,
                searchQuery: ''
            }
        },
        methods: {
            getConstituencies() {
                axios.get('api/constituencies')
                .then( response => {
                    this.constituencies = response.data
                })
                .catch( error => {
                    console.log('Error retrieving constituencies')
                })
            },
            getParties() {
                axios.get('api/parties')
                .then( response => {
                    this.parties = response.data
                })
                .catch( error => {
                    console.log('Error retrieving parties')
                })
            },
            recordResponse(e) {
                if ( this.voting == '') {
                    return;
                }

                let theResponse = {
                    response: {
                        constituency: this.constituency_selected.c_id,
                        voting: this.voting,
                        party: this.party_selected
                    }
                };

                axios.post('api/responses/store', theResponse)
                .then(response => {
                    if (response.status == 200) {
                        this.constituency_selected = '';
                        this.voting = '';
                        this.party_selected = '';
                        this.$emit('submitted');
                    }
                })
                .catch(error => {
                    console.log('There was an error recording the response');
                });
            },
            selectConstituency(constituency) {
                this.constituency_selected = constituency;
                this.searchQuery = constituency.c_name;
                this.showConstituences = false;
            }
        },
        computed: {
            filteredConstituences() {
                const query = this.searchQuery.toLowerCase();
                if (query.length == 0) return this.constituencies;
                return this.constituencies.filter((constituency) => {
                    return Object.values(constituency).some((word) => String(word).toLowerCase().includes(query));
                });
            }
        },
        created() {
            this.getConstituencies();
            this.getParties();
        }
    }
</script>

<style scoped>
    #response-form {
        margin: 2vh;

    }
    p.small {
        font-size: 0.8em;
    }
    #response-form ul {
        max-height: 10vh;
        overflow-y: scroll;
        list-style-type: none;
        padding: 10px;
        border: 1px solid #ccc;
        border-top: none;
    }
    #response-form li {
        cursor: pointer;
        padding: 5px 0;
        border-bottom: 1px solid #ccc;
    }
    #response-form li:hover {
        background: #ccc;
    }
</style>