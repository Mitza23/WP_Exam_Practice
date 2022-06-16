import { ComponentFixture, TestBed } from '@angular/core/testing';

import { SeeQuestionComponent } from './see-question.component';

describe('SeeQuestionComponent', () => {
  let component: SeeQuestionComponent;
  let fixture: ComponentFixture<SeeQuestionComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ SeeQuestionComponent ]
    })
    .compileComponents();
  });

  beforeEach(() => {
    fixture = TestBed.createComponent(SeeQuestionComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
