<template>
<div>
  <div class="form-row">
    <div class="form-group col-md-4">
      <label>Pilih Tanggal Awal</label>
      <select class="custom-select" @click="onClick($event)" v-model="tanggal_start">
        <option value="0" >--- Pilih Kategori ---</option>
        <option v-for="data in tanggals.tahun" v-bind:key="data.tahun" v-bind:value="data.tahun" >{{ data.tahun }}</option>
      </select>  
    </div>
    <div class="form-group col-md-4">
      <label>Pilih Tanggal Akhir</label>
      <select class="custom-select" @click="onClick($event)" v-model="tanggal_end">
        <option value="0" >--- Pilih Kategori ---</option>
        <option v-for="data in tanggals.tahun" v-bind:key="data.tahun" v-bind:value="data.tahun" >{{ data.tahun }}</option>
      </select>  
    </div>
  </div>
  <div class="small">
    <h5 class="title text-center"><strong>Grafik Data FGD Tahun {{ tanggal_start }} - {{ tanggal_end }}</strong></h5>
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
        tanggal_start: '2018',
        tanggal_end: '2019',
        tanggals: [],
        color: ['#ff9800','#e51515', '#15a2e5', '#1b7419', '#551974', '#741958', '#197074' , '#ff8d00', '#648c4c', '#ae98d0']
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
          axios.get('/soc/data/tahun')
          .then(response => {
            this.tanggals = response.data;
          })
        },

        onClick: function(event){    
            console.log(this.kategori);
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
                  },
                  scaleLabel: {
                    display: true,
                    labelString: 'Jumlah FGD',
                  }
                }]
              }
            }
            this.axios.get('/soc/data/chart/' + (this.tanggal_start) + '/' + (this.tanggal_end))
            .then((response) => {
              let data = response.data;
              if(data) {
                    data.forEach(element => {
                        Years.push(element.tahun);
                        Labels.push(element.tahun);
                        Total.push(element.total);
                    });
               
                    this.datacollection = {
                        labels: Years,
                        datasets: [{
                            label: 'Grafik Data FGD',
                            backgroundColor: '#ff730094',
                            borderColor: '#ff7300',
                            borderWidth: 1,
                            data: Total
                        }]
                    }, {responsive: true, maintainAspectRatio: false}
                }
            })
        },

        getColor(){
          return (this.color[Math.floor(Math.random()*this.color.length)]);
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