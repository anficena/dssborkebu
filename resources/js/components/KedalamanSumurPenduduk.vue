<template>
<div>
    <div class="form-row">
        <div class="form-group col-md-4">
            <label>Pilih Tahun Awal</label>
            <select class="custom-select" @click="onClick($event)" v-model="tahun">
                <option v-for="data in tahuns.tahun" v-bind:key="data.tahun" v-bind:value="data.tahun" >{{ data.tahun }}</option>
            </select>  
        </div>
        <div class="form-group col-md-4">
            <label>Pilih Tahun Akhir</label>
            <select class="custom-select" @click="onClick($event)" v-model="tahun_akhir">
                <option v-for="data in tahuns.tahun" v-bind:key="data.tahun" v-bind:value="data.tahun" >{{ data.tahun }}</option>
            </select>  
        </div>
        <!-- <div class="form-group col-md-4">
            <label>Pilih Bulan</label>
            <select class="custom-select" multiple="true" @click="onClick($event)" v-model="bulan">
                <option v-for="data in bulans.bulan" v-bind:key="data.bulan" v-bind:value="data.number" >{{ data.bulan }}</option>
            </select>  
        </div> -->
    </div>
    <div class="small">
        <h5 class="title text-center"><strong>Grafik Kedalaman Sumur Penduduk Sekitar Candi Borobudur Tahun {{ tahun }} - {{ tahun_akhir }}</strong></h5>
        <line-chart :height="220" :chart-data="datacollection" :options="options"></line-chart>
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
        bulan: '',
        bulans: [],
        tahun: '2017',
        tahun_akhir: '2018',
        tahuns: [],
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
          axios.get('/kedalaman_sumur/data/tahun')
          .then(response => {
            this.bulans = response.data;
            this.tahuns = response.data;
          })
        },

        

        onClick: function(event){    
            console.log(this.bulan);
            let Month = new Array();
            let Barat = new Array();
            let BaratDaya = new Array();
            let BaratLaut = new Array();
            let Selatan = new Array();
            let Tenggara = new Array();
            let Timur = new Array();
            let TimurLaut = new Array();
            let Utara = new Array();
            this.options = {
              legend: {
                position: 'bottom',
                fullWidth: true,
                labels: {
                  boxWidth: 20
                }
              },
              scales: {
                yAxes: [{
                  ticks: {
                    beginAtZero: true
                  },
                  scaleLabel: {
                    display: true,
                    labelString: 'Kedalaman (meter)',
                  }
                }]
              }
            }
            this.axios.get('/kedalaman_sumur/data/chart/' 
                    + (this.tahun) + '/' + (this.tahun_akhir))
            .then((response) => {
              let data = response.data;
              if(data) {
                    data.forEach(element => {
                        Month.push(element.month);
                        Barat.push(element.lokasi.barat);
                        BaratDaya.push(element.lokasi.barat_daya);
                        BaratLaut.push(element.lokasi.barat_laut);
                        Selatan.push(element.lokasi.selatan);
                        Tenggara.push(element.lokasi.tenggara);
                        Timur.push(element.lokasi.timur);
                        TimurLaut.push(element.lokasi.timur_laut);
                        Utara.push(element.lokasi.utara);
                    });
               
                    this.datacollection = {
                        labels: Month,
                        datasets: [{
                            label: 'Timur',
                            backgroundColor: '#25b7ed94',
                            borderWidth: 1,
                            borderColor: '#25b7ed',
                            data: Timur
                        },
                        {
                            label: 'Tenggara',
                            backgroundColor: '#ff730094',
                            borderColor: '#ff7300',
                            borderWidth: 1,
                            data: Tenggara
                        },
                        {
                            label: 'Selatan',
                            backgroundColor: '#a7a7a794',
                            borderColor: '#a7a7a7',
                            borderWidth: 1,
                            data: Selatan
                        },
                        {
                            label: 'Barat Daya',
                            backgroundColor: '#ffee58c2',
                            borderColor: '#ffee58',
                            borderWidth: 1,
                            data: BaratDaya
                        },
                        {
                            label: 'Barat',
                            backgroundColor: '#0d0ac2a1',
                            borderColor: '#0d0ac2',
                            borderWidth: 1,
                            data: Barat
                        },
                        {
                            label: 'Barat Laut',
                            backgroundColor: '#00881da1',
                            borderColor: '#00881d',
                            borderWidth: 1,
                            data: BaratLaut
                        },
                        {
                            label: 'Utara',
                            backgroundColor: '#cc0013a1',
                            borderColor: '#cc0013',
                            borderWidth: 1,
                            data: Utara
                        },
                        {
                            label: 'Timur Laut',
                            backgroundColor: '#593100a1',
                            borderColor: '#593100',
                            borderWidth: 1,
                            data: BaratDaya
                        }
                        ]
                        
                    }
                    , 
                    {
                      responsive: true, 
                      maintainAspectRatio: false}
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
    max-width: 100%;
    width: 1000px !important;
    margin:  50px auto;
  }

  .custom-select[multiple], .custom-select[size]:not([size="1"]) {
    height: auto;
    padding-right: .75rem;
    background-image: none;
}
</style>