#include <iostream>

int main() {
    std::cout << cv::getVersionMajor() << std::endl;
   std::cout << cv::getVersionMinor() << std::endl;
   std::cout << cv::getVersionRevision() << std::endl;

}