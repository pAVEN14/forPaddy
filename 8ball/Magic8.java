public class Magic8 {
  
    public static void main(final String[] args) {
      
      System.out.println("spooky 8-BALL genie says: \n");
      
      final int choice = (int) (Math.random() * 10 + 1);
      
      if (choice == 1) {
  
          System.out.println("Yes");
  
      } else if (choice == 2) {
  
          System.out.println("No");
    
      } else if (choice == 3) {


          System.out.println("Maybe");

      } else if (choice == 4) {


          System.out.println("Only if you do");

      } else if (choice == 5) {


          System.out.println("If yes, then no");


      } else if (choice == 6) {


          System.out.println("YES IF YOU HURRY!!!!");

      } else if (choice == 7) {


          System.out.println("Undoubtably no");

      } else if (choice == 8) {


          System.out.println("It will hurt");

      } else if (choice == 9) {


          System.out.println("I say no");

      } else {


          System.out.println("Yes...?");

    }
  }
}