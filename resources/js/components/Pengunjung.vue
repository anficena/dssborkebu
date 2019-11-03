<template>
<div>
  <div class="form-row">
    <div class="form-group col-md-4">
      <label>Pilih Tahun</label>
      <select class="custom-select" @click="onClick($event)" v-model="candi">
        <option value="0" >--- Pilihan ---</option>
        <option v-for="data in candis.candi" v-bind:key="data.nama" v-bind:value="data.id" >{{ data.nama }}</option>
      </select>  
    </div>
    <div class="form-group col-md-4">
      <label>Pilih Tahun</label>
      <select class="custom-select" @click="onClick($event)" v-model="tanggal_start">
        <option value="0" >--- Pilihan ---</option>
        <option v-for="data in tanggals.tahun" v-bind:key="data.tahun" v-bind:value="data.tahun" >{{ data.tahun }}</option>
      </select>  
    </div>
  </div>
  <div class="small">
    <h5 class="title text-center"><strong>Grafik Data Pengunjung Kawasan {{ candi }} Tahun {{ tanggal_start }}</strong></h5>
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
        tanggal_start: '2019',
        candi: 1,
        tanggals: [],
        candis:[],
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
          axios.get('/tingkat_pengunjung/data/tahun')
          .then(response => {
            this.tanggals = response.data;
            this.candis = response.data;
          })
        },

        onClick: function(event){    
            console.log(this.kategori);
            let Month = new Array();
            let Labels = new Array();
            let Pelajar = new Array();
            let Umum = new Array();
            let Dinas = new Array();
            let Mancanegara = new Array();
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
            this.axios.get('/tingkat_pengunjung/data/chart/' + (this.candi) + '/' + (this.tanggal_start))
            .then((response) => {
              let data = response.data;
              if(data) {
                    data.forEach(element => {
                        Month.push(element.bulan);
                        Labels.push(element.bulan);
                        Pelajar.push(element.pelajar);
                        Umum.push(element.umum);
                        Dinas.push(element.dinas);
                        Mancanegara.push(element.mancanegara);
                    });
               
                    this.datacollection = {
                        labels: Month,
                        datasets: [{
                            label: 'Pelajar',
                            backgroundColor: '#00d254a1',
                            borderColor: '#00d254',
                            borderWidth: 1,
                            data: Pelajar
                        },
                        {
                            label: 'Umum',
                            backgroundColor: '#ff9800a1',
                            borderColor: '#ff9800',
                            borderWidth: 1,
                            data: Umum
                        },
                        {
                            label: 'Dinas',
                            backgroundColor: '#15a2e5a1',
                            borderColor: '#15a2e5',
                            borderWidth: 1,
                            data: Dinas
                        },
                        {
                            label: 'Mancanegara',
                            backgroundColor: '#1b7419a1',
                            borderColor: '#1b7419',
                            borderWidth: 1,
                            data: Mancanegara
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