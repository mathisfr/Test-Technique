<template>
        <div class="bloc-popup" v-show="show">
            <div class="overlay" @click="closePopUp">

            </div>
            <div class="popup bg-white shadow-xl sm:rounded-lg max-w-4xl">
                <button @click="closePopUp" class="btn-popup bg-red-500 text-white hover:bg-red-700 h-auto py-2 px-4 min-w-max">X</button>
                <div class="flex flex-col sm:flex-row sm:m-3 border-b-2 border-gray-200">
                    <img class="w-full sm:w-80 sm:m-3" src="/images/blue.png" alt="">
                    <div class="flex flex-col sm:flex-row w-full justify-around">
                        <div class="flex flex-col m-3">
                            <p>{{company.name}}</p>
                            <p><span class="font-bold">Site internet:</span> <a :href="'https://'+website">{{website}}</a></p>
                            <p>{{phone}}</p>
                            <div class="mt-3">
                                <span v-show="haveEmail" class="ico"><a :href="'mailto:'+email">📧</a></span>
                                <span v-show="havePhone" class="ico"><a :href="'tel:'+email">📞</a></span>
                            </div>
                        </div>
                        <div class="flex flex-col m-3">
                            <p><span class="font-bold">Ville:</span> {{rewrite(company.city)}}</p>
                            <p><span class="font-bold">Code postal:</span> {{company.zip}}</p>
                            <p><span class="font-bold">Pays:</span> {{rewrite(company.country)}}</p>
                        </div>
                    </div>
                </div>
                <div class="flex sm:flex-row flex-col m-3  border-b-2 border-gray-200">
                    <p class="m-3"><span class="font-bold">Secteur:</span> {{rewrite(company.sector)}}</p>
                    <p class="m-3"><span class="font-bold">Nombre d'employers:</span> {{employers}}</p>
                    <p class="m-3"><span class="font-bold">Chiffre d'affaire:</span> {{turnover}}</p>
                </div>
                <div class="flex flex-col sm:m-3  border-b-2 border-gray-200">
                    <p class="mx-3 font-bold">Description:</p>
                    <p class="mx-3 mb-3 mt-1">{{description}}</p>
                </div>
                <div class="flex flex-col sm:flex-row sm:m-3">
                    <img class="w-40 m-3" src="/images/blue.png" alt="">
                    <div class="flex flex-col sm:flex-row w-full justify-around">
                        <div class="flex flex-col m-3">
                            <p><span class="font-bold">Prénom:</span> {{contact.firstName}}</p>
                            <p><span class="font-bold">Email:</span> {{email}}</p>
                        </div>
                        <div class="flex flex-col m-3">
                            <p><span class="font-bold">Nom:</span> {{contact.lastName}}</p>
                            <p><span class="font-bold">Téléphone:</span> {{phone}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</template>

<script>

export default {
    name: 'PopUp',
    data(){
        return{
            contact : this.objectContact,
            companyObject: this.objectCompany,
            id : this.id,

            // Pour afficher ou non les boutons cliquables "Email" et "Téléphone", voir les computed: phone et email 
            haveEmail: true,
            havePhone: true
        }
    },
    props:['show','id','objectCompany', 'objectContact'],
    methods:{
        // Envoie un nouvel événement quand le bouton fermé est cliqué pour pouvoir fermer le pop-up
        closePopUp: function(){
            this.$emit('close-popup');
        },

        // Permets de réécrire correctement certaines informations avec la première lettre en majuscules et le reste en minuscule puis s'il y a des tirets, les remplacer par des espaces
        rewrite: function(sectorName){
            sectorName = sectorName.replace('_', ' ');
            let newNameSector = sectorName.charAt(0).toUpperCase() + sectorName.slice(1).toLowerCase();
            return newNameSector;
        }
    },
    computed:{
        // Récupère les informations par rapport à une company sélectionnée
        company: function(){
            return this.companyObject[this.id];
        },

        // Récupère le chiffre d'affaires annuel, puis ajoute un signe "€" s'il existe
        turnover: function(){
            if(this.company.turnover != '0' && this.company.turnover != ''){
                return this.company.turnover+'€';
            }else{
                return 'Aucune information';
            }
        },

        // Récupère le nombre d'employers
        employers: function(){
            if(this.company.employers != '0' && this.company.employers != ''){
                return this.company.employers;
            }else{
                return 'Aucune information';
            }
        },

        // Récupère la desription puis affichier "Aucune description" si il y en a pas
        description: function(){
            if(this.company.description != 'Aucune information' && this.company.description != ''){
                return this.company.description;
            }else{
                return 'Aucune description';
            }
        },

        // Récupère le numéro de téléphone et affichier "Aucun numéro" si il y en a pas
        phone: function(){
            if(this.company.phone != 'Aucune information' && this.company.phone != ''){
                this.havePhone = true;
                return this.company.phone;
            }else{
                this.havePhone = false;
                return 'Aucun numéro';
            }
        },

        // Récupère l'email puis affichier "Aucun email" si il y en a pas
        email: function(){
            if(this.contact.email != 'Aucune information' && this.contact.email != ''){
                this.haveEmail = true;
                return this.contact.email;
            }else{
                this.haveEmail = false;
                return 'Aucun email';
            }
        },

        // Récupère le site web puis affichier "Aucun site web" si il y en a pas
        website: function(){
            if(this.company.website != 'Aucune information' && this.company.website != ''){
                return this.company.website;
            }else{
                return 'Aucun site web';
            }
        }
    }
}
</script>

<style scoped>
    .bloc-popup{
        position: fixed;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        overflow: scroll;
    }

    .overlay{
        position: fixed;
        width: 100%;
        height: 100%;
        background-color:rgba(0, 0, 0, 0.445);
    }

    .popup{
        position: relative;
    }

    .btn-popup{
        position: absolute;
        right: 0;
        top: 0;
    }

    .ico{
        cursor: pointer;
        padding: 0.2rem;
        background-color: white;
        border: 2px solid rgb(108, 99, 255);
        border-radius: 50%;
        margin-right: 0.75rem;
    }

    @media (max-width: 1024px) {
        .popup{
            max-width: 100vw;
            position: relative;
        }
    }

    @media (max-width: 640px) {
        .btn-popup{
            top:96%;
            right: 0px;
            bottom: 0px;
        }
    }

</style>