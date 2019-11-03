<template>
    <div>
        <div class="card">
            <div class="card-body">
            <div class="input-group no-border">
                <input type="text" value="" class="form-control" @keyup.enter="searchData" v-model="search" placeholder="Masukan kata kunci untuk melihat data publikasi kemudian tekan enter...">
                <div class="ripple-container"></div>
            </div>
            {{message}}
            </div>
        </div>
        <div class="card" v-for="data in publications" v-bind:key="data.id" >
            <h5 class="card-header"><strong>{{data.judul}}</strong></h5>
            <div class="card-body">
                <img v-bind:src="data.file" alt="..." class="img-thumbnail float-left" style="width: 90px; height: 110px;">
                <!-- <h5 class="card-title">Special title treatment</h5> -->
                <!-- <p class="card-category">User information</p> -->
                <i class="fa fa-fw fa-calendar"></i><strong>Tanggal</strong>: {{data.tanggal}} &ensp;&ensp;
                <i class="fa fa-fw fa-user"></i><strong>Penulis</strong>: {{data.penulis}} &ensp;&ensp;
                <i class="fa fa-fw fa-folder-open-o"></i><strong>Kategori</strong>: {{data.kategori}}
                <p class="card-category">{{data.abstrak}}</p>
                <a :href="'kajian/'+data.id" class="btn btn-social btn-fill btn-facebook btn-sm btn_show"><i class="fa fa-fw fa-search"></i> Preview</a>
                
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data(){
        return {
            search: "",
            message: "",
            publications: {}
        }
    },
    mounted() {
            this.searchData();
    },
    methods: {
        searchData() {
            Fire.$emit('searching');
        }
    },
    created() {
        Fire.$on('searching',() => {
            axios.get('kajian/search/publikasi/' + (this.search))
            .then((response) => {
                // console.log(count(response.data))
                
                this.publications = response.data
                if(this.publications.length == 0){
                     this.message = "Tidak ditemukan data berdasarkan keyword yang dimasukan.";}
                else
                    this.message = "";
                
            })
            .catch((error) => {
                
            })
        })
    }
}
</script>