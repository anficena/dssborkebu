<template>
<div>
  <div class="form-row">
    <div class="form-group col-md-4">
      <label>Pilih Kategori Observasi</label>
      <select class="custom-select" @click="onClick($event)" v-model="kategori">
        <option value="0" >--- Pilih Kategori ---</option>
        <option v-for="data in kategoris.kategori" v-bind:key="data.jenis_id" v-bind:value="data.jenis_observasi" >{{ data.jenis_observasi }}</option>
      </select>  
    </div>
    <div class="form-group col-md-4">
      <label>Pilih Tanggal Awal</label>
      <select class="custom-select" @click="onClick($event)" v-model="tanggal_start">
        <option value="0" >--- Pilih Tahun Awal ---</option>
        <option v-for="data in tanggals.tahun" v-bind:key="data.tahun" v-bind:value="data.tahun" >{{ data.tahun }}</option>
      </select>  
    </div>
    <div class="form-group col-md-4">
      <label>Pilih Tanggal Akhir</label>
      <select class="custom-select" @click="onClick($event)" v-model="tanggal_end">
        <option value="0" >--- Pilih Tahun Akhir ---</option>
        <option v-for="data in tanggals.tahun" v-bind:key="data.tahun" v-bind:value="data.tahun" >{{ data.tahun }}</option>
      </select>  
    </div>
  </div>
  <div class="small">
    <h5 class="title text-center"><strong>Grafik Data Observasi {{ kategori }} Tahun {{ tanggal_start }} - {{ tanggal_end }}</strong></h5>
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
        kategori : 'Sampah',
        kategoris: [],
        tanggal_start: 2015,
        tanggal_end: 2019,
        tanggals: []
      }
    },
    mounted () {
      this.fillData(),
      this.getKategori(),
      this.onClick()
    },
    methods: {
        fillData () {
            
        },

        getKategori: function(){
          axios.get('/monev_batu/data/kategori')
          .then(response => {
            this.kategoris = response.data;
            this.tanggals = response.data;
            console.log(response.data);
          })
          
        },

        onClick: function(event){            
            let Years = new Array();
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
            this.axios.get('/monev_batu/data/chart/'+ (this.tanggal_start) +'/' + (this.tanggal_end) + '/' + (this.kategori))
            .then((response) => {
              let data = response.data;
              if(data) {
                    data.forEach(element => {
                        Years.push(element.tahun);
                        Labels.push(element.jenis_observasi);
                        Total.push(element.total);
                    });
               
                    this.datacollection = {
                        labels: Years,
                        datasets: [{
                            label: Labels[0],
                            backgroundColor: '#25b7ed94',
                            borderWidth: 1,
                            borderColor: '#25b7ed',
                            data: Total
                        }]
                    }, {responsive: true, maintainAspectRatio: false}
                }
            })
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