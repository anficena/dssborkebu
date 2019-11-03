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
    </div>
    <div class="small">
        <h5 class="title text-center"><strong>Grafik Kedalaman Sumur Resapan Sekitar Candi Borobudur Tahun {{ tahun }} - {{ tahun_akhir }}</strong></h5>
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
          axios.get('kedalaman_resapan/data/tahun')
          .then(response => {
            this.tahuns = response.data;
          })
        },

        onClick: function(event){    
            console.log(this.bulan);
            let Lokasi = new Array();
            let Bulan = new Array();
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
            this.axios.get('/kedalaman_resapan/data/chart/' 
                            + (this.tahun) + '/' + (this.tahun_akhir))
            .then((response) => {
              let data = response.data;
            //   console.log(data[0].kedalaman);
              if(data) {
                    data.forEach(element => {
                        Lokasi.push(element.lokasi);
                        Bulan.push(element.kedalaman);
                    });
                    console.log(Bulan[0][5]);

                        var dataSetValue = [];
                        var bgColor = ['#25b7ed94', '#ff730094', '#a7a7a794', '#ffee58c2', '#0d0ac2a1', '#00881da1', '#cc0013a1'];
                        var brColor = ['#25b7ed', '#ff7300', '#a7a7a7', '#ffee58', '#0d0ac2', '#00881d', '#cc0013'];
                        for(var j = 0; j <= Bulan.length - 1; j++){
                            for(var k = 0; k <= Bulan[j].length - 1; k++){
                            // Bulan.forEach(element => {

                            // })
                                dataSetValue[k] = {
                                    label: [Bulan[0][k][0]],
                                    backgroundColor: bgColor[k],
                                    borderWidth: 1,
                                    borderColor: brColor[k],
                                    data: [Bulan[0][k][1], Bulan[1][k][1], Bulan[2][k][1], Bulan[3][k][1],
                                            Bulan[4][k][1], Bulan[5][k][1], Bulan[6][k][1]]
                                }
                            }
                            
                        }
                        console.log(dataSetValue);
                        
               
                        this.datacollection = {
                        labels: Lokasi,

                        datasets: dataSetValue
                    },
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