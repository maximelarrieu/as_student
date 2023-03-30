"use strict"

class Manager extends personnelDuParc {
    constructor(nom, prenom, employeesList) {
        super(nom, prenom);
        this.employeeList = employeesList;
    }

    isManagedByEmployee() {
        if () {
            console.log("Manager : Quoi ?! Votre dernière expérience au " + attractionName + 
            " avec " + employeeName + " ne vous a pas convaincu ?? Laissez moi vous dédommager. Tenez voilà " 
            + attractionAmout + " euros de " + lastAttractionName)
        } else {
            console.log("Manager ; Je ne connais pas cet employé, je ne suis pas son manager")
        }
    }
}
