import { Component, OnInit } from '@angular/core';
import { Router, ActivatedRoute } from '@angular/router';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.css']
})
export class LoginComponent implements OnInit {

  constructor(
      private activatedRoute: ActivatedRoute,
      private router: Router
  ) { }

  ngOnInit() {
  }

  public onSubmit(): void {
      this.router.navigate(['../selection']);
  }

}
