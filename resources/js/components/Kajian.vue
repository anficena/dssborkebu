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
    <h5 class="title text-center"><strong>Grafik Data Kajian Tahun {{ tanggal_start }} - {{ tanggal_end }}</strong></h5>
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
        tanggal_start: '2016',
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
          axios.get('/kajian/data/tahun')
          .then(response => {
            this.tanggals = response.data;
          })
        },

        onClick: function(event){    
            console.log(this.kategori);
            let Years = new Array();
            let Labels = new Array();
            let Kkcb1 = new Array();
            let Kkcb2 = new Array();
            let Kkcb3 = new Array();
            let Pmtk = new Array();
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
                    labelString: 'Jumlah Kajian',
                  }
                }]
              }
            }
            this.axios.get('/kajian/data/chart/' + (this.tanggal_start) + '/' + (this.tanggal_end))
            .then((response) => {
              let data = response.data;
              if(data) {
                    data.forEach(element => {
                        Years.push(element.tahun);
                        Labels.push(element.kategori);
                        Kkcb1.push(element.kkcb1);
                        Kkcb2.push(element.kkcb2);
                        Kkcb3.push(element.kkcb3);
                        Pmtk.push(element.pmtk);
                    });
               
                    this.datacollection = {
                        labels: Years,
                        datasets: [{
                            label: 'KKCB1',
                            backgroundColor: '#25b7ed94',
                            borderWidth: 1,
                            borderColor: '#25b7ed',
                            data: Kkcb1
                        },
                        {
                            label: 'KKCB2',
                            backgroundColor: '#ff730094',
                            borderColor: '#ff7300',
                            borderWidth: 1,
                            data: Kkcb2
                        },
                        {
                            label: 'KKCB3',
                            backgroundColor: '#00881da1',
                            borderColor: '#00881d',
                            borderWidth: 1,
                            data: Kkcb3
                        },
                        {
                            label: 'PMTK',
                            backgroundColor: '#ffee58c2',
                            borderColor: '#ffee58',
                            borderWidth: 1,
                            data: Pmtk
                        }
                        ]
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