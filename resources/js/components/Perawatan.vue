<template>
<div>
  <div class="form-row">
    <div class="form-group col-md-4">
      <label>Pilih Cagar Budaya</label>
      <select class="custom-select" @click="onClick($event)" v-model="cagar">
        <option value="0" >--- Pilih Kategori ---</option>
        <option v-for="data in cagars.cagar" v-bind:key="data.id" v-bind:value="data.id" >{{ data.nama }}</option>
      </select>
    </div>
    <div class="form-group col-md-4">
      <label>Pilih Kategori Observasi</label>
      <select class="custom-select" @click="onClick($event)" v-model="kategori">
        <option value="0" >--- Pilih Kategori ---</option>
        <option v-for="data in kategoris.kategori" v-bind:key="data.kategori_id" v-bind:value="data.kategori" >{{ data.kategori }}</option>
      </select>  
    </div>
    <div class="form-group col-md-4">
      <label>Pilih Tahun</label>
      <select class="custom-select" @click="onClick($event)" v-model="tanggal">
        <option value="0" >--- Pilih Kategori ---</option>
        <option v-for="data in tanggals.tahun" v-bind:key="data.tahun" v-bind:value="data.tahun" >{{ data.tahun }}</option>
      </select>  
    </div>
  </div>
  <div class="small">
    <h5 class="title text-center"><strong>Grafik Data Perawatan Dan Pemeliharaan {{ kategori }} Tahun {{ tanggal }}</strong></h5>
    <line-chart :height="200" :chart-data="datacollection" :options="options"></line-chart>
  </div>
</div>
</template>

<script>
import LineChart from './LineChart.js'

export default {
    components: {
      LineChart
    },
    data () {
      return {
        datacollection: null,
        options: null,
        cagar: 1,
        cagars: [],
        kategori : 'Pembersihan',
        kategoris: [],
        tanggal: 2019,
        tanggals: [],
        bgColor: ['#25b7ed94', '#ff730094', '#a7a7a794', '#ffee58c2', '#0d0ac2a1', '#00881da1', '#cc0013a1'],
        brColor: ['#25b7ed', '#ff7300', '#a7a7a7', '#ffee58', '#0d0ac2', '#00881d', '#cc0013']
      }
    },
    mounted () {
      this.getKategori(),
      this.onClick()
    },
    methods: {
        fillData () {
            
        },

        getKategori: function(){
          axios.get('/perawatan/data/kategori')
          .then(response => {
            this.kategoris = response.data;
            this.tanggals = response.data;
            this.cagars = response.data;
            console.log(response.data);
          })
          
        },

        onClick: function(event){    
            console.log(this.kategori);
            let Month = new Array();
            let Labels = new Array();
            let Total = new Array();
            this.options = {
              legend: {
                position: 'bottom',
              },
              scales: {
                yAxes: [{
                  ticks: {
                    beginAtZero: true
                  }
                  // scaleLabel: {
                  //   display: true,
                  //   labelString: 'Jumlah FGD',
                  // }
                }]
              }
            }
            this.axios.get('/perawatan/data/chart/' + (this.cagar) + '/' + (this.kategori) + '/' + (this.tanggal))
            .then((response) => {
              let data = response.data;
              if(data) {
                    data.forEach(element => {
                        Month.push(element.bulan);
                        Labels.push(element.kategori);
                        Total.push(element.total);
                    });
               
                    this.datacollection = {
                        labels: Month,
                        datasets: [{
                            label: Labels[0],
                            backgroundColor: this.getColor(),
                            borderColor: this.getBorderColor(),
                            borderWidth: 1,
                            data: Total
                        }]
                    }, {responsive: true, maintainAspectRatio: false}
                }
            })
        },

        getColor(){
          return (this.bgColor[Math.floor(Math.random()*this.bgColor.length)]);
        },

        getBorderColor(){
          return (this.brColor[Math.floor(Math.random()*this.brColor.length)]);
        }
    }
}

</script>

<style>
  .small {
    max-width: 80%;
    margin:  50px auto;
  }
</style>