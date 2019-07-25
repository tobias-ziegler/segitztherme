import { Component, OnInit, ViewChild, ElementRef } from "@angular/core";
import { HttpClient } from "@angular/common/http";
import { Router } from "@angular/router";

@Component({
    selector: "app-masterdata",
    templateUrl: "./masterdata.component.html",
    styleUrls: ["./masterdata.component.css"]
})
export class MasterdataComponent implements OnInit {
    @ViewChild("consumableDescription", { static: false })
    public consumableDescription: ElementRef;

    @ViewChild("consumablePrice", { static: false })
    public consumablePrice: ElementRef;

    @ViewChild("consumableTax", { static: false })
    public consumableTax: ElementRef;

    @ViewChild("chipId", { static: false })
    public chipId: ElementRef;

    @ViewChild("employeeFirstName", { static: false })
    public employeeFirstName: ElementRef;

    @ViewChild("employeeLastName", { static: false })
    public employeeLastName: ElementRef;

    @ViewChild("employeeStreet", { static: false })
    public employeeStreet: ElementRef;

    @ViewChild("employeeCity", { static: false })
    public employeeCity: ElementRef;

    @ViewChild("employeePostalCode", { static: false })
    public employeePostalCode: ElementRef;

    public consumables: any;
    public chips: any;
    public employees: any;
    public vipCustomers: any;

    constructor(private httpClient: HttpClient, private router: Router) {}

    ngOnInit() {
        this.getConsumables();
        this.getChips();
        this.getEmployees();
        this.getVipCustomers();
    }

    private getConsumables(): void {
        this.httpClient
            .get("http://localhost:80/api/consumable/get.php")
            .subscribe(response => {
                this.consumables = response;
            });
    }

    private getChips(): void {
        this.httpClient
            .get("http://localhost:80/api/chip/get.php")
            .subscribe(response => {
                this.chips = response;
            });
    }

    private getEmployees(): void {
        this.httpClient
            .get("http://localhost:80/api/employee/get.php")
            .subscribe(response => {
                this.employees = response;
            });
    }

    private getVipCustomers(): void {
        this.httpClient
            .get("http://localhost:80/api/vipCustomer/get.php")
            .subscribe(response => {
                this.vipCustomers = response;
            });
    }

    public createConsumable(event): void {
        event.stopPropagation();
        this.httpClient
            .post(
                "http://localhost:80/api/consumable/create.php",
                JSON.stringify({
                    id: 0,
                    bezeichnung: this.consumableDescription.nativeElement.value,
                    preis: this.consumablePrice.nativeElement.value,
                    steuer: this.consumableTax.nativeElement.value
                })
            )
            .subscribe(() => {
                this.getConsumables();
            });
    }

    public updateConsumable(event, consumable): void {
        event.stopPropagation();
        this.httpClient
            .post(
                "http://localhost:80/api/consumable/update.php",
                JSON.stringify(consumable)
            )
            .subscribe(response => {
                this.getConsumables();
            });
    }

    public deleteConsumable(event, id): void {
        event.stopPropagation();
        this.httpClient
            .post(
                "http://localhost:80/api/consumable/delete.php",
                JSON.stringify({
                    id: id
                })
            )
            .subscribe(response => {
                this.getConsumables();
            });
    }

    public createChip(event): void {
        event.stopPropagation();
        this.httpClient
            .post(
                "http://localhost:80/api/chip/create.php",
                JSON.stringify({
                    id: this.chipId.nativeElement.value
                })
            )
            .subscribe(() => {
                this.getChips();
            });
    }

    public deleteChip(event, id): void {
        event.stopPropagation();
        this.httpClient
            .post(
                "http://localhost:80/api/chip/delete.php",
                JSON.stringify({
                    id: id
                })
            )
            .subscribe(response => {
                console.log(response);
                this.getChips();
            });
    }

    public createEmployee(event): void {
        event.stopPropagation();
        this.httpClient
            .post(
                "http://localhost:80/api/employee/create.php",
                JSON.stringify({
                    id: 0,
                    nachname: this.employeeLastName.nativeElement.value,
                    vorname: this.employeeFirstName.nativeElement.value,
                    strasse: this.employeeStreet.nativeElement.value,
                    ort: this.employeeCity.nativeElement.value,
                    plz: this.employeePostalCode.nativeElement.value,
                    login: "",
                    passwort: ""
                })
            )
            .subscribe(() => {
                this.getEmployees();
            });
    }

    public updateEmployee(event, employee): void {
        event.stopPropagation();
        this.httpClient
            .post(
                "http://localhost:80/api/employee/update.php",
                JSON.stringify(employee)
            )
            .subscribe(() => {
                this.getEmployees();
            });
    }

    public deleteEmployee(event, id): void {
        event.stopPropagation();
        this.httpClient
            .post(
                "http://localhost:80/api/employee/delete.php",
                JSON.stringify({
                    id: id
                })
            )
            .subscribe(() => {
                this.getEmployees();
            });
    }

    public onMenuButtonClicked() {
        this.router.navigate(["selection"]);
    }
}
