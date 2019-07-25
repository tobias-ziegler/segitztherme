import { LoginComponent } from "./../login/login.component";
import { HttpClient } from "@angular/common/http";
import { Component, OnInit } from "@angular/core";
import { Router } from "@angular/router";

interface CartItem {
    id: number;
    description: string;
    price: number;
    tax: number;
    count: number;
}

@Component({
    selector: "app-restaurant",
    templateUrl: "./restaurant.component.html",
    styleUrls: ["./restaurant.component.css"]
})
export class RestaurantComponent implements OnInit {
    public consumables: any;
    public total: number = 0;

    constructor(private httpClient: HttpClient, private router: Router) {}

    ngOnInit() {
        this.httpClient
            .get("http://localhost:80/api/consumable/get.php")
            .subscribe(response => {
                this.consumables = response;
                this.initCart();
                this.consumables = this.createChunks(this.consumables);
            });
    }

    private initCart() {
        for (let i = 0; i < this.consumables.length; i++) {
            this.consumables[i]["count"] = 0;
        }
    }

    private createChunks(consumables): Array<any> {
        const consumablesChunks = [];
        for (let i = 0; i < consumables.length; i += 3) {
            consumablesChunks.push(consumables.slice(i, i + 3));
        }
        return consumablesChunks;
    }

    public addToCart(event, consumable): void {
        event.stopPropagation();
        consumable["count"]++;
        this.total = this.calculateTotal();
    }

    public removeFromCart(event, consumable): void {
        event.stopPropagation();
        if (consumable["count"] - 1 >= 0) {
            consumable["count"]--;
        }
        this.total = this.calculateTotal();
    }

    public calculateTotal(): number {
        let total: number = 0;
        for (let i = 0; i < this.consumables.length; i++) {
            for (let j = 0; j < this.consumables[i].length; j++) {
                total +=
                    this.consumables[i][j].count * this.consumables[i][j].preis;
            }
        }
        return total;
    }

    private getCart(): Array<any> {
        const cartItems: Array<any> = [];
        for (let i = 0; i < this.consumables.length; i++) {
            for (let j = 0; j < this.consumables[i].length; j++) {
                if (this.consumables[i][j].count > 0) {
                    cartItems.push(this.consumables[i][j]);
                }
            }
        }
        return cartItems;
    }

    public onBookButtonClicked() {
        sessionStorage.setItem(
            "cartTotal",
            JSON.stringify({ total: this.calculateTotal() })
        );
        this.httpClient
            .post(
                "http://localhost:80/api/Restaurant.php",
                JSON.stringify(this.getCart())
            )
            .subscribe(() => {
                window.location.reload(false);
            });
    }

    public onMenuButtonClicked() {
        this.router.navigate(["selection"]);
    }
}
