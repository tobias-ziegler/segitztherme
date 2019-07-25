import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { CheckinSuccesfulComponent } from './checkin-succesful.component';

describe('CheckinSuccesfulComponent', () => {
  let component: CheckinSuccesfulComponent;
  let fixture: ComponentFixture<CheckinSuccesfulComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ CheckinSuccesfulComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(CheckinSuccesfulComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
