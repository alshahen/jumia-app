<template>
    <div id="customers">
        <ul class="nav nav-pills">
            <li class="nav-item dropdown">
                <button class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Country</button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#" @click="selectedCountry = null">All</a></li>
                    <li v-for="country in countries"><a class="dropdown-item" href="#" @click="selectedCountry = country">{{ country }}</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <button class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Phone State</button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#" @click="state = null">All</a></li>
                    <li><a class="dropdown-item" href="#" @click="state = 'valid'">OK</a></li>
                    <li><a class="dropdown-item" href="#" @click="state = 'invalid'">NOK</a></li>
                </ul>
            </li>
        </ul>

        <table class="table">
            <thead>
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Country</th>
                <th scope="col">Country Code</th>
                <th scope="col">State</th>
                <th scope="col">Phone</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="customer in customers">
                <th>{{ customer.name }}</th>
                <td>{{ customer.country }}</td>
                <td>+{{ customer.code}}</td>
                <td>{{ customer.state ? 'OK' : 'NOK'  }}</td>
                <td>{{ customer.phone }}</td>
            </tr>
            </tbody>
        </table>


    </div>
</template>

<script>
    import axios from "axios"
    export default {
        data(){
          return {
              countries : ['morocco', 'cameroon', 'ethiopia', 'mozambique', 'uganda'],
              selectedCountry : null,
              state : null,
              customers : [],
          }
        },
        methods:{
            getCustomers : function(){
                axios.get('/customers', {
                    params : {
                        page: this.page,
                        state: this.state,
                        country: this.selectedCountry
                    }
                }).then((response) => {
                    this.customers = response.data;
                }).catch((response) => {

                });
            }
        },
        watch:{
            selectedCountry : function(){
              this.getCustomers();
            },
            state : function(){
                this.getCustomers();
            }

        },
        mounted() {
            this.getCustomers();
        }
    }
</script>
