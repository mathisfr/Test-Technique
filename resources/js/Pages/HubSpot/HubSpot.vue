<template>
    <app-layout>
        <div class="py-12" id="hubspot">
            <div class="max-w-1xl mx-auto sm:px-6 lg:px-8">
                <select @change="choiceSector" class="mb-4 rounded" name="" id="">
                    <option value="all">Afficher tout</option>
                    <option :value="sector" v-for="(sector, key) in this.sector" :key="key">{{rewrite(sector)}}</option>
                </select>
                <PopUp v-if="requete" :show="show" :objectCompany="companiesList" :objectContact="contact" :id="currentId" @close-popup="togglePopUp" />
                <Companies @click-button="togglePopUp(key)" v-for="(company, key) in filterEvents(currentSector)" :key="key">
                    <template v-slot:name>
                        {{company.name}}
                    </template>
                    <template v-slot:sector>
                        {{rewrite(company.sector)}}
                    </template>
                    <template v-slot:city>
                        {{rewrite(company.city)}}
                    </template>
                    <template v-slot:country>
                        {{rewrite(company.country)}}
                    </template>
                </Companies>
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'
import Companies from '@/Pages/HubSpot/Parts/Companies'
import PopUp from '@/Pages/HubSpot/Parts/PopUp'

export default {
    data(){
        return{
            currentSector:'all', // Le secteur actuellement séléctionner (par défaut "all" pour tout afficher)
            
            sector:[], // Tous les secteurs disponible
            
            companiesList: this.companies, // L'objet qui contient toutes les informations passées à notre vue avec le model "Company.php"
            
            currentId : 0, //L'id actuel, cette id est passé dans la fonction togglepopup() pour afficher les bonnes informations par rapport à la bonne entreprise dans le pop-up.
            
            show : false, // Cette variable est passer au popup, si c'est vrai on affiche, si c'est faux on n'affiche plus. Cette variable est moddifier par la fonction togglePopUp()

            contact : null, // Le contacte qui va être chargé avec la requête axios et passé en paramètre du popup

            requete: false, // Permet d'ajouter ou non le popup dans le DOM
        }
    },
    props:['companies'],
    components: {
            AppLayout,
            Companies, // Le component Companies.vue, pour lister les entreprises.
            PopUp // Le component PopUp.vue, pour avoir les informations complémentaires dans un popup
        },
    methods:{

        // Permets de filtrer les entreprises avec un secteur en particulier dans la boucle <Compagnies>
        filterEvents: function(sectorEvent){
            if(sectorEvent === "" || sectorEvent === "all"){
                return this.companiesList;
            }else{
                return this.companiesList.filter(event => event.sector === sectorEvent);
            }
        },

        // Permet de récupérer le secteur sélectionner avec la balise <select>
        choiceSector: function(newSector){
            this.currentSector = newSector.target.value;
        },

        // Permet d'afficher et fermer le popup, et s'il y a un "id" le mettre dans la variable "currentId" qui permet de récupérer les bonnes informations par rapport à l'entreprise dans le pop-up.
        togglePopUp: function(id){
            if(typeof id !== 'undefined'){
                this.currentId = id; 
                // Une requête HTTP de type GET pour récupérer le contact par rapport à l'id d'une entreprise
                axios
                .get("http://kaffein.test/api/getContact/"+(this.currentId+1))
                .then(response => {
                    /*
                    * Si l'application a une réponse, on passe requête à "true" pour avoir le popup dans le DOM.
                    * Puis une fois qu'il est dans le DOM, on l'affiche.
                    */
                    if(this.contact = response.data){
                        if(this.requete = true){
                            this.show = !this.show;
                        }
                    }

                    })
                .catch(error => console.log(error));
            }else{
                // Juste pour la fermeture du popup
                this.requete = false;
                this.show = !this.show;
            }
            
        },

        // Permets de réécrire correctement certaines informations avec la première lettre en majuscules et le reste en minuscule puis s'il y a des tirets, les remplacer par des espaces
        rewrite: function(sectorName){
            sectorName = sectorName.replace('_', ' ');
            let newNameSector = sectorName.charAt(0).toUpperCase() + sectorName.slice(1).toLowerCase();
            return newNameSector;
        }
    },
    mounted(){
        // Fait une première requête axios au montage de l'application pour ne pas avoir un popup vide de base
        axios
        .get("http://kaffein.test/api/getContact/1")
        .then(response => (this.contact = response.data))
        .catch(error => console.log(error));  
    },
    mounted(){

        // Permets de récupérer tous les secteurs des entreprises dans un tableau "sector" sans qu'il y ait de doublon pour pouvoir les affichers ensuite dans la liste déroulante
        this.companiesList.forEach(element => {
            var item = element.sector;
            if(!this.sector.includes(item)){
                this.sector.push(item);                
            }
        })   
    }
}
</script>

<style>

</style>